<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body style="display: flex; flex-direction: column; margin: 0 auto; text-align: center; align-content: center; justify-content: center">
    <h3>Order Details</h3>
    <br>
    <h5>Order No: {{$data->order_no}}</h5>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Total Price</th>
                <th>Total Quantity</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->price}} BDT</td>
                <td>{{$data->qty}}</td>
                <td>{{$data->payment_method}}</td>
                <td>{{$data->txn_id}}</td>
                <td>{{$data->status}}</td>
            </tr>

        </tbody>
    </table>
    <br>
    <h3>Products</h3>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->order_details as $item)
                <tr>
                    <td>{{$item->order_id}}</td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->price}} BDT</td>
                    <td>{{$item->qty}}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    
</body>
</html>