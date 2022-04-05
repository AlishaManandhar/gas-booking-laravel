@extends('layout.app')

@section('title', 'Home')
@section('content')
    <div class="container bg-light">
        <div class="row mt-3">
            @foreach($products as $product)
                <div class="col-sm-12 col-md-4 mb-3">
                        <div class="card mb-3">
                            <img src="{{asset('storage/products/'.$product->image)}}" width="100%" height="250px" style="object-fit: contain" class="card-img-top p-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Rs {{ $product->price }}</p>
                                <a href="{{ route('product.show', $product->name) }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                </div>
            @endforeach
        </div>
    </div>

    @endsection
