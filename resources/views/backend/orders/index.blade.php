@extends('layouts.backend')

@section('main')
<h3 class="text-center">Order list</h3>
<table class="table">
   <thead>
     <tr>
       <th scope="col">NO</th>
       <th scope="col">User Name</th>
       <th scope="col">Order NO</th>
       <th scope="col">Price</th>
       <th scope="col">Status</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach($orders as $key=>$order)
       <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$order->user->name}}</td>
            <td>{{$order->order_no}}</td>
            <td>{{number_format($order->price)}} BDT</td>
            <td>{{$order->status}}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{route('admin.order.edit', $order->id)}}">Edit</a>
                <a class="btn btn-sm btn-danger" href="{{route('admin.order.delete', $order->id)}}">Delete</a>
            </td>
       </tr>
     @endforeach
   </tbody>
 </table>
 {{$orders->links()}}

@endsection