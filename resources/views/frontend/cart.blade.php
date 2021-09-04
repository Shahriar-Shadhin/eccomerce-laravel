@extends('layouts.frontend')

@section('main')

    @php
        $si = 1;
        $total_qty = 0;
        $total_price = 0;
    @endphp
    <h1>Cart</h1>
    <div class="row">
        <table class="table table-bordered text-center ">
            <thead class="table-dark">
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            @foreach ($cart as $item)
            <tbody>
                <td>{{$si}}</td>
                <td class="text-center"><img src="{{asset('upload/products/'. $item['photo'])}}" height="50" alt="img"></td>
                <td>{{$item['name']}}</td>
                <td>{{$item['price']}} BDT</td>
                {{-- <td class="d-flex flex-row justify-content-around">
                    <button class="btn btn-outline-primary border rounded-pill px-3">+</button>
                    <span class="py-2">{{$item['quantity']}}</span>
                    <button class="btn btn-outline-danger border rounded-pill px-3">-</button>
                </td> --}}
                <td>{{$item['quantity']}}</td>
                <td>{{$item['quantity'] * $item['price']}} BDT</td>
                <td>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tbody>
            @php
                $si++;
                $total_qty += $item['quantity'];
                $total_price = $total_price + $item['quantity']*$item['price'];
            @endphp
            @endforeach
            
            <tfoot>
                <th class="text-center table-success" colspan="4">Total</th>
                <th class=" table-success">{{$total_qty}}</th>
                <th class=" table-success text-danger">{{$total_price}} BDT</th>
                <th class=" table-success text-danger"></th>
    
            </tfoot>
        </table>
        
            <div class="">
                @if ($total_qty == 0)
                    <h3 class="text-danger">Please add product to cart !</h3>
                @else
                <form action="{{route('do.order')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="p-method" class="form-label">Payment Method</label>
                            <select name="p-method" class="form-control" id="p-method">
                                <option value="bkash">BKash</option>
                                <option value="nagad">Nagad</option>
                                <option value="rocket">Rocket</option>
                            </select>
                        </div>
                        <input type="hidden" name="total-price" value="{{$total_price}}">
                        <input type="hidden" name="total-qty" value="{{$total_qty}}">
                        <div class="col">
                            <label for="txn-id" class="form-label">Transection ID</label>
                            <input type="text" required class="form-control" id="txn-id" name="txn-id">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark">Place Order</button>
                        </div>
                    </div>
                </form>
                @endif
                
            </div>
        
    </div>
    
        
    
@endsection