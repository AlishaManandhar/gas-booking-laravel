@extends('layout.app')
@section('title', 'My Orders')

@section('content')
    <div class="row mt-3">
        <div class="col-sm-6 col-md-10 offset-md-1">
            @if(count($orders) == 0)
                <div class="alert alert-danger">
                    <strong>No orders found</strong>
                </div>
            @else
                <div class="table-responsive-xl">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Delivery</th>
                            <th scope="col">TotalPrice</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->product->name }}</td>
                                <td>{{$order->product->price }}</td>
                                <td>{{$order->quantity }}</td>
                                <td>Rs 50</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->user->fullname}}</td>
                                <td>{{$order->user->phone}}</td>
                                <td>{{$order->location}} </td>
                                <td>
                                    @if($order->status == 'pending')
                                        <a href="{{ route('order.status', $order->id) }}" class="btn btn-primary">Process the order</a>
                                    @elseif($order->status == 'processing')
                                        <a href="{{ route('order.status', $order->id) }}" class="btn btn-danger">Complete the order</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
