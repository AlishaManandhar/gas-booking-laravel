@extends('layout.app')

@section('title', 'Edit Product')

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 col-12 offset-md-3">

            <h3>Edit Product</h3>
            <form action="{{route('product.update',$product->name)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                @include('product._form', ['product' => $product])
                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
            </form>
        </div>
    </div>

@endsection
