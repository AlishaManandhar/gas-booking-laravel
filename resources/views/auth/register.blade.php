@extends('layout.app')

@section('title', 'SignUp')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 col-12 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Create User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('register')}}" method="post" class="p-3">
                            @csrf
                            @include('auth._form')
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>


@endsection
