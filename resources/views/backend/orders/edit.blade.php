@extends('layouts.backend')

@section('main')
<div class="row p-4">
    
    <div class="col-md-6">
       <h3 class="text-center mt-2">Edit Order</h3>
       @if ($errors->any())
          <div class="alert alert-danger">
             <ul>
                @foreach ($errors->all() as $error)
                   <li><strong>{{ $error }}</strong></li>
                @endforeach
             </ul>
          </div>
       @endif
       <form action="{{route('admin.order.edit', $order->id)}}" method="POST" >
          @csrf
          <div class="form-group mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" class="form-control" id="name"  value="{{$order->user->name}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="order_no" class="form-label">Order NO</label>
            <input type="text" class="form-control" id="order_no"  value="{{$order->order_no}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price"  value="{{$order->price}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="qty" class="form-label">Quantity</label>
            <input type="text" class="form-control" id="qty"  value="{{$order->qty}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="p_method" class="form-label">Payment Method</label>
            <input type="text" class="form-control" id="p_method"  value="{{$order->payment_method}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="txn_id" class="form-label">Transaction ID</label>
            <input type="text" class="form-control" id="txn_id"  value="{{$order->txn_id}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="date" class="form-label">Order Date</label>
            <input type="text" class="form-control" id="date"  value="{{$order->created_at}}" readonly>
          </div>
          <div class="form-group mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option selected value="{{$order->status}}">{{$order->status}}</option>
                <option value="confirm">Confirm</option>
                <option value="reject">Reject</option>
                <option value="delevired">Delevired</option>
                <option value="complete">Complete</option>
            </select>
          </div>
            <div class="d-grid gap-2"> 
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
          
        </form>
    </div>
    <div class="col-md-6">
        <h3 class="text-center mt-2">Products</h3>
        <table class="table">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </thead>
            <tbody>
                @foreach ($order->order_details as $key => $item)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->qty}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
 </div>
@endsection