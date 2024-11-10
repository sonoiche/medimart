<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Client\Transaction;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function store(Request $request)
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
        
        $order = new Transaction();
        $order->customer_id         = $request['customer_id'];
        $order->product_id          = $content[0]['product_id'];
        $order->payment_method      = $request['payment_method'];
        $order->seller_id           = $request['seller_id'];
        $order->order_number        = strtoupper(Str::random(10));
        $order->total_amount        = str_replace(',','',Cart::total());
        $order->transaction_type    = 'Pending';

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $order->proof_of_payment = $imagePath;
        }

        $order->save();

        Cart::destroy();
        
        return response()->json(['success' => true]);
    }
}
