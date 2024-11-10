<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Client\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request['user_id'];
        $data['data'] = Product::with('seller')
            ->when($user_id, function ($query, $user_id) {
                $query->where('user_id', $user_id);
            })->latest()->get();

        return response()->json($data);
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
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id       = $request['user_id'];
        $product->title         = $request['title'];
        $product->description   = $request['description'];
        $product->price         = $request['price'];
        $product->status        = 'In Stock';

        if($request->has('photo')) {
            $imageData = $request->file('photo');
            $filename   = uniqid() . '.jpg';

            Storage::disk('s3')->putFileAs(
                "medimart/uploads/products",
                $imageData,
                $filename,
                'public'
            );
            
            $product->photo = Storage::disk('s3')->url("medimart/uploads/products/{$filename}");
        }

        $product->save();

        $data['message'] = 'Product item has been updated.';
        $data['success'] = true;
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $what = $request['what'];
        switch ($what) {
            case 'delete':
                
                $product = Product::find($id);
                $product->delete();

                return response()->json(200);

                break;
            
            default:
                
                $data['data'] = Product::with('seller')->find($id);
                return response()->json($data);

                break;
        }
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
        $product = Product::find($id);
        $product->title         = $request['title'];
        $product->description   = $request['description'];
        $product->price         = $request['price'];
        $product->status        = $request['status'];

        if($request->has('photo')) {
            $imageData = $request->input('photo');

            $filename = uniqid() . '.jpg';
            $file   = base64_decode($imageData);

            Storage::disk('s3')->put(
                "medimart/uploads/products/{$filename}",
                $file,
                'public'
            );
            
            $product->photo = Storage::disk('s3')->url("medimart/uploads/products/{$filename}");
        }

        $data['message'] = 'Product item has been updated.';
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(200);
    }
}
