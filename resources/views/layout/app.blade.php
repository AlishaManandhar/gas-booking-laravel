<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <title>Gas Booking - @yield('title','')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"> Gas Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto  ms-md-5  ps-md-5 mb-2 mb-lg-0">
                    @auth()
                        <li class="nav-item me-md-5">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        @if(auth()->user()->role == 'admin' )
                            <li class="nav-item dropdown pe-5">
                                <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Products
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="productDropdown">
                                    <li><a class="dropdown-item" href="{{route('product.create')}}">Create</a></li>
                                    <li><a class="dropdown-item" href="{{route('product.index')}}">View Products</a></li>
                                </ul>
                            </li>

                                <li class="nav-item dropdown pe-5">
                                    <a class="nav-link dropdown-toggle" href="#" id="orderDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Orders
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="orderDropdown">
                                        <li><a class="dropdown-item" href="{{route('order.index')}}">View Orders</a></li>
                                        <li><a class="dropdown-item" href="{{route('order.sale-history')}}">Sales History</a></li>
                                    </ul>
                                </li>
                        @endif

                        <li class="nav-item me-md-5">
                            <a class="nav-link" href="{{route('order.my-orders')}}">MyOrders</a>
                        </li>
                        <li class="nav-item me-md-5">
                            <a class="nav-link" href="{{route('order.history')}}">History</a>
                        </li>
                        <li class="nav-item me-md-5">
                            <a class="nav-link" href="{{route('review.index')}}">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                        @endauth
                </ul>

                <span class="navbar-text">
                    @auth()
                        <a href="/logout" class="btn btn-outline-danger">Logout</a>
                    @else
                        <a href="/login" class="btn btn-outline-primary">Login</a>
                        <a href="/register" class="btn btn-outline-success">Register</a>
                    @endauth
                </span>
            </div>
        </div>
    </nav>
    <div class="container">
            @yield('content')
        @if(session()->has('success'))
            <div id="success-flash">
                {{ session()->get('success') }}
                <script>
                    window.setTimeout(function() {
                        document.getElementById("success-flash").style.display = "none";
                    }, 2000);
                </script>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
