@extends('layout.app')

@section('title', 'Product')

@section('content')
            <div class="card mt-5 mx-auto" style="max-width: 800px;">
                <div class="row mt-3">
                    <div class="col-md-5">
                        <img src="{{asset('/storage/products/'.$product->image)}}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><small class="text-muted">Price: <span class="text-danger">{{$product->price}}</span></small></p>
                            @guest()
                                <a href="{{route('login')}}" class="btn btn-primary mt-3">Login to order</a>
                            @endguest
                            @auth()
                                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="false" aria-controls="collapseExample">
                                    Book now
                                </button>
                            @endauth
                            <div class="collapse mt-3" id="order">
                                @auth()
                                    @include('order._form',['productId'=>$product->id,'route'=>route('order.store'),'buttonText'=>'Order now', 'price'=>$product->price])
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

