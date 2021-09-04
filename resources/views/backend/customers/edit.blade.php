@extends('layouts.backend')
@section('main')
<div class="row">
   <div class="col-md-2">

   </div>
   <div class="col-md-8">
      <h3 class="text-center mt-2">Edit Customer</h3>
      <form action="{{route('admin.customer.edit', $customer->id)}}" method="POST">
         @csrf
         <div class="form-group mb-3">
           <label for="name">Customer Name</label>
           @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                     @endforeach
                  </ul>
               </div>
            @endif
           <input type="text" value="{{$customer->name}}" class="form-control" id="name" name="name"  placeholder="Enter Customer Name">
           
         </div>
         <div class="form-group mb-3">
            <label for="email">Customer Email</label>
            <input type="email" value="{{$customer->email}}" class="form-control" name="email" id="email"  placeholder="Enter Customer Email">
            
          </div>
          <div class="form-group mb-3">
            <label for="phone">Customer Phone</label>
            <input type="text" value="{{$customer->phone}}" class="form-control" name="phone" id="phone"  placeholder="Enter Customer Phone Number">
            
          </div>
          <div class="form-group mb-3">
            <label for="address">Customer Address</label>
             <textarea name="address"  class="form-control" id="address" cols="30" rows="2">{{$customer->address}}</textarea>            
          </div>
         
          <div class="d-grid gap-2"> 
            <button type="submit" class="btn btn-primary mt-3">Submit</button>

          </div>
         
       </form>
   </div>
</div>

@endsection