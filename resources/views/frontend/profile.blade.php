@extends('layouts.frontend')

@section('main')
<div class="container ">
    <div class="row">
        {{-- <div class="col-md-3"></div> --}}
        <div class="col-md-6">
            <div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
                @endif
            </div>
            <h3>Profile</h3>
            <hr>
            <form action="{{route('profile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$user['name']}}" >
                  </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" value="{{$user['email']}}">
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" name="phone" class="form-control" id="phone" value="{{$user['phone']}}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="address">{{$user['address']}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Profile Picture</label>
                    <input type="file" name="photo" class="form-control" id="photo">
                </div>
                <div class="mb-3">
                    <img src="{{asset('upload/users/'. auth()->user()->photo)}}" class="form-controll rounded-3" alt="photo" height="150">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
        </div>
        <div class="col-md-6">
            <h3>Orders</h3>
            <hr>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    <tr>
                        <th>{{$key + 1}}</th>
                        <td>{{$order->order_no}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->price}} BDT</td>
                        <td>{{$order->qty}}</td>
                        <td>{{$order->created_at->format('d-m-y')}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection