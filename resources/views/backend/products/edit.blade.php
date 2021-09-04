@extends('layouts.backend')
@section('main')
<div class="row p-4">
   <div class="col-md-2">

   </div>
   <div class="col-md-8">
      <h3 class="text-center mt-2">Edit Products</h3>
      <form action="{{route('admin.product.edit', $product->id)}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group mb-3">
            <label for="name">Product Name</label>
            @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                     @endforeach
                  </ul>
               </div>
            @endif
           <input type="text" value="{{$product->name}}" class="form-control" id="name" name="name"  placeholder="Enter product name">
           
         </div>
         <div class="form-group mb-3">
            <label for="price">Product Price</label>
            <input type="number" value="{{$product->price}}" class="form-control" name="price" id="price"  placeholder="Enter product price">
            
          </div>
          <div class="form-group mb-3">
            <label for="desc">Product Description</label>
             <textarea name="desc"  class="form-control" id="desc" cols="30" rows="5">{{$product->desc}}</textarea>            
          </div>
          <div class="mb-3">
            <label for="photo" class="form-label">Product Photo</label>
            <input type="file" name="photo" class="form-control" id="photo">
            <hr>
            <img src="{{asset('upload/products/'. $product->photo)}}" alt="img" height="50">
          </div>
         
          <div class="d-grid gap-2"> 
            <button type="submit" class="btn btn-primary mt-3">Submit</button>

          </div>
         
       </form>
   </div>
</div>

@endsection