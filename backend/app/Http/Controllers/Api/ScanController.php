<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Client\ScanObject;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use SapientPro\ImageComparatorLaravel\Facades\Comparator;
use SapientPro\ImageComparator\Strategy\DifferenceHashStrategy;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(
            new Driver()
        );
        
        if($request->has('photo')) {
            $imageData = $request->input('photo');
        
            $filename  = uniqid() . '.jpg';
            $file      = base64_decode($imageData);

            Storage::disk('public')->put(
                "medimart/uploads/archives/{$filename}",
                $file
            );

            $imageStoragePath = storage_path("app/public/medimart/uploads/archives");
            // Check if the directory exists, if not, create it
            if (!file_exists($imageStoragePath)) {
                mkdir($imageStoragePath, 0755, true);
            }


            $image = $manager->read(Storage::disk('public')->get("medimart/uploads/archives/{$filename}"));
            $image->scale(width: 500)->toJpeg();
            $image->save("{$imageStoragePath}/{$filename}");

            $id = $this->comparator("{$imageStoragePath}/{$filename}");

            $plants = config('medimart.plants');
            
            if($plants[$id[0]]['scientific'] != '') {
                return response()->json([
                    'name'          => $plants[$id[0]]['name'],
                    'scientific'    => $plants[$id[0]]['scientific'],
                    'uses'          => $plants[$id[0]]['uses'],
                    'heals'         => $plants[$id[0]]['heals'],
                    'preperation'   => $plants[$id[0]]['preperation'],
                    'id'            => $plants[$id[0]]['id'],
                    'photo'         => $plants[$id[0]]['photo'],
                    'message'       => 'Found matches'
                ], 200);
            }

            return response()->json([
                'name'          => '',
                'scientific'    => '',
                'uses'          => '',
                'heals'         => '',
                'preperation'   => '',
                'id'            => '',
                'photo'         => '',
                'message'       => 'No match found.'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['data'] = ScanObject::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function imageRekognition($filename)
    {
        $client = new RekognitionClient([
            'region'    => config('filesystems.disks.s3.region'),
            'version'   => 'latest',
            'credentials' => [
                'key'       => config('app.aws_rekognition_key'),
                'secret'    => config('app.aws_rekognition_secret'),
            ],
        ]);

        $sourceBytes    = Storage::disk('public')->get("medimart/uploads/archives/{$filename}");
        $targetImages   = Storage::disk('s3')->files('medimart/uploads/plants/');
        $faceMatches    = [];
        foreach ($targetImages as $targetImage) {
            $targetBytes = Storage::disk('s3')->get($targetImage);
            $result = $client->compareFaces([
                'SourceImage' => [
                    'Bytes' => $sourceBytes
                ],
                'TargetImage' => [
                    'Bytes' => $targetBytes
                ]
            ]);

            $plant    = explode('.', basename($targetImage));
            if(count($result['FaceMatches'])) {
                $faceMatches[]  = [
                    'similarity'    => $result['FaceMatches'][0]['Similarity'],
                    'plant_id'      => $plant[0]
                ];
            }
        }

        usort($faceMatches, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        $topFaceMatch = array_slice($faceMatches, 0, 1);
        return $topFaceMatch[0];
    }

    private function comparator($filename)
    {
        $directory      = 'plants';
        $files          = [
            public_path($directory . '/2.jpg'),
            public_path($directory . '/3.jpg'),
            public_path($directory . '/4.jpg'),
            public_path($directory . '/5.jpg'),
            public_path($directory . '/6.jpg')
        ];
        $plant          = [];
        Comparator::setHashStrategy(new DifferenceHashStrategy());

        foreach ($files as $file) {
            $similarity = Comparator::compare($filename, $file);
            if($similarity >= 60) {
                $plant[]  = explode('.', basename($file));
                break;
            }
        }
        
        return (count($plant) > 0) ? $plant[0] : [1];
    }

    private function getImageEmbedding($base64Image)
    {
        $response = OpenAI::embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => $base64Image,
        ]);

        return $response['data'][0]['embedding'];
    }

    private function findMostSimilarImage($uploadedEmbedding, $existingEmbeddings)
    {
        $maxSimilarity = -1;
        $mostSimilarIndex = -1;

        foreach ($existingEmbeddings as $index => $embedding) {
            $similarity = $this->cosineSimilarity($uploadedEmbedding, $embedding);
            if ($similarity > $maxSimilarity) {
                $maxSimilarity = $similarity;
                $mostSimilarIndex = $index;
            }
        }

        return $mostSimilarIndex;
    }

    private function cosineSimilarity($vecA, $vecB)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        for ($i = 0; $i < count($vecA); $i++) {
            $dotProduct += $vecA[$i] * $vecB[$i];
            $normA += $vecA[$i] ** 2;
            $normB += $vecB[$i] ** 2;
        }

        return $dotProduct / (sqrt($normA) * sqrt($normB));
    }
}
