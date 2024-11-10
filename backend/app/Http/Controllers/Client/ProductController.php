<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Product;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Client\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('client.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id       = auth()->user()->id;
        $product->title         = $request['title'];
        $product->description   = $request['description'];
        $product->price         = $request['price'];
        $product->status        = $request['status'];
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            Storage::disk('s3')->put(
                'medimart/uploads/products/' . $photo,
                file_get_contents($file),
                'public'
            );
            
            $product->photo = Storage::disk('s3')->url('medimart/uploads/products/' . $photo);
        }
        $product->save();

        return redirect()->to('client/products')->with('success', 'The product has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['product'] = Product::find($id);
        return view('client.products.edit', $data);
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
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            Storage::disk('s3')->put(
                'medimart/uploads/products/' . $photo,
                file_get_contents($file),
                'public'
            );
            
            $product->photo = Storage::disk('s3')->url('medimart/uploads/products/' . $photo);
        }
        $product->save();

        return redirect()->to('client/products')->with('success', 'The product has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        Storage::disk('s3')->delete('medimart/uploads/products/'.basename($product->photo));
        $product->delete();

        return response()->json(200);
    }
}
