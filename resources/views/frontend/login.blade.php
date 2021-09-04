@extends('layouts.frontend')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
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
            <form action="{{route('login')}}" method="POST">
                @csrf
                {{-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            
                <div class="form-floating">
                  <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                  <label for="email">Email address</label>
                </div>
                <br>
                <div class="form-floating">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  <label for="password">Password</label>
                </div>
            
                {{-- <div class="checkbox mb-3">
                  <label>
                    <input type="checkbox" value="remember-me"> Remember me
                  </label>
                </div> --}}
                <br>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
            </form>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>
@endsection