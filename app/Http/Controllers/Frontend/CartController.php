<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function showCart(){
        $cart = session()->has('cart') ? session()->get('cart') : [];
        // dd($cart);
        return view('frontend.cart', compact('cart'));
    }

    public function addtoCart($id){
        $product = Product::find($id);
        
        $cart = session()->has('cart') ? session()->get('cart') : [];
        if(array_key_exists($product->id, $cart)){
        
            $cart[$product->id]['quantity'] += 1;
        }else{
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'photo' => $product->photo
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('message', 'Product Added To Cart');

    }
}
