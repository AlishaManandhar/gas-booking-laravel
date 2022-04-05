@extends('layout.app')
@section('title', 'History')

@section('content')
    <div class="row mt-3">
        <div class="col-sm-6 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>GasBrand</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>ShippingCost</th>
                                    <th>Total</th></th>
                                    <th>Delivered At</th>
                                    <th>Image</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$order->product->name}}</td>
                                        <td class="text-danger">{{$order->product->price}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>Rs 50</td>
                                        <td>Rs {{ $order->total}}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td> <img src="{{asset('storage/products/'.$order->product->image)}}" width="200px"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
