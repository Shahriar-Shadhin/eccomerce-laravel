<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderController extends Controller
{
    public function doOrder(Request $req){
        try {
            DB::beginTransaction();
            $cart = session()->has('cart') ? session()->get('cart') : [];

            $data = [
                'user_id' => auth()->user()->id,
                'order_no' => 'Order_' . auth()->user()->id . '_' . time(),
                'price' => $req->input('total-price'),
                'qty' => $req->input('total-qty'),
                'payment_method' => $req->input('p-method'),
                'txn_id' => $req->input('txn-id'),
                'status' => "pending",
            ];
    
            $order = Order::create($data);
            
            foreach($cart as $item){
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'qty' => $item['quantity'],
                ]);
            }
            Mail::to(auth()->user()->email)->send(new OrderMail($order));

            DB::commit();
            session()->forget('cart');
            return redirect()->route('profile');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
      


    }
}
