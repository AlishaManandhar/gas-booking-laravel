@extends('layout.app')

@section('title', 'Add Product')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 col-12 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Creating Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            @include('product._form')
                            <button type="submit" class="btn btn-primary mt-3">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection
