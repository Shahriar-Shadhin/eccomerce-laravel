@extends('layouts.frontend')

@section('main')
<section class="mb-5">

    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="mdb-lightbox">
          <div class="row product-gallery mx-1">
            <div class="col-12 mb-0">
              <figure class="view overlay rounded z-depth-1 main-img">
                <a href="{{asset('upload/products/'. $product->photo)}}"
                  data-size="710x823">
                  <img src="{{asset('upload/products/'. $product->photo)}}"
                    class="img-fluid z-depth-1" height="300">
                </a>
              </figure>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 p-4">
  
        <h5>{{$product->name}}</h5>
        <p><span class="mr-1"><strong>{{$product->price}} BDT</strong></span></p>
        <p class="pt-1">{{$product->desc}}</p>
        <hr>
        <button type="button" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
        <a type="button" class="btn btn-dark btn-md mr-1 mb-2"><i
            class="fas fa-shopping-cart pr-2"></i>Add to cart</a>
      </div>
    </div>
  
  </section>

  <section class="mb-5">
    <div class="row">
        <p><strong>Recent Products </strong></p>
        
    @foreach ($products as $product)
    <div class="col-md-4 mb-4 mb-md-0">
    <div class="card">
        <img
          src="{{asset('upload/products/'. $product->photo)}}"
          class="card-img-top"
          alt="..."
          width="200"
        />
        <div class="card-body">
          <h5 class="card-title">{{$product->name}}</h5>
          {{-- <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the
            card's content.
          </p>
          <a href="#!" class="btn btn-primary">Button</a> --}}
        </div>
      </div>
    </div>

    @endforeach
    </div>
  </section>
  <!--Section: Block Content-->
@endsection