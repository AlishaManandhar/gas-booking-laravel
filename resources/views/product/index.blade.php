@extends('layout.app')
@section('title', 'Products')

@section('content')
    <div class="row mt-3">
        <div class="col-sm-12 col-md-10 offset-md-1">
            @if(count($products) == 0)
                <div class="alert alert-danger">
                    <strong>No products found</strong>
                </div>
            @else
            <div class="table-responsive-xl">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name </th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}"  width="100%" height="250px" style="object-fit: contain">
                                </td>
                                <td> <a href="{{route('product.show',$product->name)}}">{{ $product->name }}</a> </td>
                                <td width="140px">{{ substr($product->description,0,60 ) . "..."}}</td>

                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->name) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('product.status', $product->id) }}" class="btn btn-danger">{{$product->status == "active" ? "Inactive" : "Active"}}</a>
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
