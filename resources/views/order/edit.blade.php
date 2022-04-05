@extends('layout.app')
@section('title', 'Edit Order')

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 col-12 offset-md-3">

            <h3>Edit Order</h3>
            @include('order._form',['order' =>$order,'route'=>route('order.update', $order->id),'buttonText'=>'Save changes'])

        </div>
    </div>
@endsection
