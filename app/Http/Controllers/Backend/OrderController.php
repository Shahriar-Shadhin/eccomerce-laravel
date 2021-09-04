<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function delete($id){
       
        try {
        
            DB::beginTransaction();
            $order = Order::where('id',$id)->with('order_details')->first();
            
            foreach($order->order_details as $item){
                $item->delete();
            }

            $order->delete();

            DB::commit();

            return redirect()->back();
    
        } catch (\Throwable $th) {
            DB::rollBack();
        }
     
    }
    public function update(Request $req, $id){
        Order::find($id)->update(['status' => $req->input('status')]);

        return redirect()->route('admin.order');
    }
    public function edit($id){
        $order = Order::where('id',$id)->with('user', 'order_details')->first();
        // dd($order);
        return view('backend.orders.edit', compact('order'));

    }
    public function index(){
        $orders = Order::orderBy('id', 'desc')->paginate('9');
        
        return view('backend.orders.index', compact('orders'));
    }


}
