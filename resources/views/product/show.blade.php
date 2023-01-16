<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Show Product</title>

    <!-- Bootstrap core CSS -->
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <style>
        .product {
            background-color: #eee
        }

        .brand {
            font-size: 13px
        }

        .act-price {
            color: red;
            font-weight: 700
        }

        .dis-price {
            text-decoration: line-through
        }

        .about {
            font-size: 14px
        }

        .color {
            margin-bottom: 10px
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            padding: 2px 9px;
            border: 2px solid #ff0000;
            display: inline-block;
            color: #ff0000;
            border-radius: 3px;
            text-transform: uppercase
        }

        label.radio input:checked+span {
            border-color: #ff0000;
            background-color: #ff0000;
            color: #fff
        }

        .btn-danger {
            background-color: #ff0000 !important;
            border-color: #ff0000 !important
        }

        .btn-danger:hover {
            background-color: #da0606 !important;
            border-color: #da0606 !important
        }

        .btn-danger:focus {
            box-shadow: none
        }

        .cart i {
            margin-right: 10px
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <h2>ROOSEN</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/index') }}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/product/all') }}#product">Our Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/index#about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/index#contact') }}">Contact Us</a>
                        </li>
                        </li>
                        <li class="nav-item mt-1">
                            @if (auth()->user())
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->name }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/home') }}">Home</a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Logout</button>
                                        </form>
                                        @if (auth()->user()->role == 'pembeli')
                                            <a class="dropdown-item" href="{{ url('/cart') }}"><i
                                                    class="fa-solid fa-cart-shopping text-danger"></i> Cart (
                                                {{ count(auth()->user()->cart) }} )</a>
                                        @endif
                                    </div>
                                </div>
                        </li>
                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/login') }}">login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <div class="page-heading contact-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Product Page</h4>
                        <h2>Welcome back</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12" id="product">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                @error('product_id')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image"
                                        src="{{ asset('storage/' . $product->gambar) }}" width="250"
                                        class="img-thumbnail shadow-sm" /> </div>
                                <div class="thumbnail text-center"> <img onclick="change_image(this)"
                                        src="{{ asset('storage/' . $product->gambar) }}" width="70"
                                        class="img-thumbnail shadow-sm"> <img onclick="change_image(this)"
                                        src="{{ asset('storage/' . $product->gambar) }}" width="70"
                                        class="img-thumbnail shadow-sm"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span
                                            class="ml-1"><a href="/product/all"
                                                class="text-decoration-none text-danger text-uppercase">Back</a></span>
                                    </div> <i class="fa fa-shopping-cart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3"> <span class="text-muted brand">{{ $product->user ? $product->user->name : 'unknow' }}</span>
                                    <h5 class="text-uppercase">{{ $product->nama }}</h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">
                                        Rp . {{ number_format($product->harga, 2, ',', '.') }}
                                    </span>
                                    </div>
                                </div>
                                <p class="about">{{ $product->keterangan }}</p>
                                <div class="sizes" style="margin-top: 100px;">
                                    <h6 class="text-uppercase">Stok : </h6>
                                    <button class="btn btn-warning text-white"><i class="fas fa-store-alt"></i>
                                        {{ $product->stok }}</button>

                                </div>
                                @if ($cart == null)
                                    <form action="{{ route('cart.store') }}" method="POST">
                                @else
                                    <form action="{{ route('cart.destroy',$product->id) }}" method="POST">
                                    @method('delete')
                                @endif
                                @csrf
                                <div class="col-5 d-flex mt-4">
                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                        type="button">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input id="form1" min="0" max="{{ $product->stok }}" name="qty"
                                        value="1" type="number" class="form-control form-control-sm" />

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                        type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="cart mt-4 align-items-center">
                                    <button class="btn btn-danger text-uppercase mr-2 px-4" type="submit"><i
                                            class="fa fa-cart-plus mr-2"></i>{{ $cart == null ? 'add to cart' : 'remove from cart' }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; {{ date('Y') }} Roosen Co., Ltd.

                            - Design: <a rel="nofollow noopener" target="_blank">Roosen</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- Additional Scripts -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/isotope.js') }}"></script>
    <script src="{{ asset('js/accordions.js') }}"></script>



    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>


</body>

</html>
