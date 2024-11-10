<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::content();
        $content = [];
        foreach ($carts as $cart) {
            $content[] = [
                'id'            => $cart->id,
                'name'          => $cart->name,
                'price'         => $cart->price,
                'quantity'      => $cart->qty,
                'row_id'        => $cart->rowId,
                'subtotal'      => $cart->subtotal,
                'tax'           => $cart->tax,
                'customer_id'   => $cart->options->customer_id,
                'photo'         => $cart->options->photo
            ];
        }

        $data['data']           = [
            'content'       => $content,
            'tax'           => Cart::tax(),
            'cart_total'    => Cart::total(),
            'cart_subtotal' => Cart::subtotal(),
            'seller'        => ''
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cartSeller()
    {
        $carts      = Cart::content();
        $content    = [];
        foreach ($carts as $cart) {
            $content[] = [
                'id'            => $cart->id,
                'name'          => $cart->name,
                'price'         => $cart->price,
                'quantity'      => $cart->qty,
                'row_id'        => $cart->rowId,
                'subtotal'      => $cart->subtotal,
                'tax'           => $cart->tax,
                'customer_id'   => $cart->options->customer_id,
                'photo'         => $cart->options->photo,
                'product_id'    => $cart->options->product_id
            ];
        }

        $cart_id    = explode('-', $content[0]['id']);
        $seller_id  = end($cart_id);
        
        $data['data']   = User::find($seller_id);

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_id     = $request['herbal_id'];
        $quantity       = $request['quantity'];
        $price          = $request['price'];
        $product        = Product::find($product_id);

        Cart::add([
            'id'        => uniqid('cart_') . '-' . $product->user_id,
            'name'      => $product->title,
            'qty'       => $quantity,
            'price'     => $price,
            'weight'    => 0,
            'options'   => [
                'customer_id' => $request['customer_id'],
                'photo'       => $product->photo,
                'product_id'  => $product_id
            ]
        ]);

        $data['statusCode'] = 200;

        return response()->json($data, 200);
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
        Cart::remove($id);
        $carts = Cart::content();
        $content = [];
        foreach ($carts as $cart) {
            $content[] = [
                'id'            => $cart->id,
                'name'          => $cart->name,
                'price'         => $cart->price,
                'quantity'      => $cart->qty,
                'row_id'        => $cart->rowId,
                'subtotal'      => $cart->subtotal,
                'tax'           => $cart->tax,
                'customer_id'   => $cart->options->customer_id,
                'photo'         => $cart->options->photo
            ];
        }

        $data['data']           = [
            'content'       => $content,
            'tax'           => Cart::tax(),
            'cart_total'    => Cart::total(),
            'cart_subtotal' => Cart::subtotal()
        ];

        return response()->json($data, 200);
    }
}
