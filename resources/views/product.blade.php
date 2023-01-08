@extends('template.layout')

@section('main')
    <style>
        .mt-50 {

            margin-top: 50px;
        }

        .mb-50 {

            margin-bottom: 50px;
        }



        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .1875rem;
        }

        .card-img-actions {
            position: relative;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
            text-align: center;
        }

        .card-img {}

        .star {
            color: rgb(239, 224, 3);
        }

        .bg-cart {
            background-color: rgb(255, 0, 0);
            color: #fff;
        }

        .bg-cart:hover {

            color: #fff;
        }

        .bg-buy {
            background-color: green;
            color: #fff;
            padding-right: 29px;
        }

        .bg-buy:hover {

            color: #fff;
        }

        a {

            text-decoration: none !important;
        }
    </style>
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-lg-12">
                <h1 class="text-danger">Our Products</h1>
            </div>
        </div>
    </div>
    <div class="container mt-50 mb-50">
        
        <div class="row">
            {{ $product->links() }}
            @foreach ($product as $pro)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 d-flex justify-content-center">
                    <div class="card shadow mb-3" style="width: 23rem;">
                        <img src="{{ asset('storage/'.$pro->gambar) }}" class="card-img-top p-3 shadow-sm" alt="..." height="300">
                        <div class="card-body">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-2">
                                    <a href="#" class="text-danger mb-2" data-abc="true">{{ $pro->nama }}</a>
                                </h6>

                            </div>

                            <h3 class="mb-0 font-weight-semibold">Rp . {{ $pro->harga }}</h3>

                            <div class="text-dark">
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                            </div>

                            <div class="text-dark mb-3">Stok : {{ $pro->stok }}</div>

                            <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to
                                cart</button>
                            <a href="" class="btn btn-outline-danger rounded"><i class="fas fa-eye"></i></a>

                        </div>
                      </div>
                </div>
                
            @endforeach

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{ $product->links() }}
            </div>
        </div>
    </div>
@endsection
