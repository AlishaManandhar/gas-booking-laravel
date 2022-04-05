@extends('layout.app')
@section('title', 'Sale-History')

@section('content')
    <div class="row mt-3">
        <div class="col-sm-6 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>GasBrand</th>
                                <th>Quantity</th>
                                <th>ShippingCost</th>
                                <th>Total</th></th>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Delivered At</th>
                                <th>Image</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>Rs 50</td>
                                    <td>Rs {{ $order->total }}</td>
                                    <td>{{$order->user->fullname}}</td>
                                    <td>{{$order->user->phone}}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                    <td> <img src="{{asset('storage/products/'.$order->product->image)}}" width="200px"></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 offset-md-4 mt-3">
            <?php $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];  ?>
                <div class="table-responsive">
                    <table class="table caption-top">
                        <caption>Sales Data per month</caption>
                        <tr>
                            <th>Month</th>
                            <th>Total</th>
                        </tr>
                        @foreach($months as $month)
                            @if(isset($stats[$month]))
                                <tr>
                                    <td>{{$month}}</td>
                                    <td>Rs {{$stats[$month]}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
@endsection
