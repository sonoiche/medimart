<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
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
    public function index(Request $request)
    {
        $searchTerm = 'Mimosa';
        $result = null;

        foreach (config('medimart.plants') as $plant) {
            if (isset($plant['plant_id']) && stripos($plant['plant_id'], $searchTerm) !== false) {
                $result = $plant;
                break; // Stop searching once we find the plant
            }
        }

        return $result;
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

            $comparePlant   = $this->plantCompare($imageData);
            $result         = $comparePlant['result']['classification']['suggestions'][0];
            $plant_name     = explode(' ', $result['name']);
            
            $plants = null;

            foreach (config('medimart.plants') as $plant) {
                if (isset($plant['plant_id']) && stripos($plant['plant_id'], $plant_name[0]) !== false) {
                    $plants = $plant;
                    break;
                }
            }
        
            // $filename  = uniqid() . '.jpg';
            // $file      = base64_decode($imageData);

            // Storage::disk('public')->put(
            //     "medimart/uploads/archives/{$filename}",
            //     $file
            // );

            // $imageStoragePath = storage_path("app/public/medimart/uploads/archives");
            // // Check if the directory exists, if not, create it
            // if (!file_exists($imageStoragePath)) {
            //     mkdir($imageStoragePath, 0755, true);
            // }

            // $image = $manager->read(Storage::disk('public')->get("medimart/uploads/archives/{$filename}"));
            // $image->scale(width: 500)->toJpeg();
            // $image->save("{$imageStoragePath}/{$filename}");

            // $id = $this->comparator("{$imageStoragePath}/{$filename}");

            // $plants = config('medimart.plants');
            
            if($plants['scientific'] != '') {
                return response()->json([
                    'name'          => $plants['name'],
                    'scientific'    => $plants['scientific'],
                    'uses'          => $plants['uses'],
                    'heals'         => $plants['heals'],
                    'preperation'   => $plants['preperation'],
                    'id'            => $plants['id'],
                    'photo'         => $plants['photo'],
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

    private function plantCompare($image)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://plant.id/api/v3/identification',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "images": [
                "data:image/jpg;base64,'.$image.'"
            ],
            "similar_images": true
        }',
        CURLOPT_HTTPHEADER => array(
            'Api-Key: jtcjKUICxdQZJWwJPsXR9R3UvrsPC3GEIiIawxKClfjarkBdqh',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);

    }
}
