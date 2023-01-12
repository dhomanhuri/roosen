@extends('template.layout')

@section('main')
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
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
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
                                <div class="mt-4 mb-3"> <span class="text-muted brand">{{ $product->user->name }}</span>
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
                                            class="fa fa-cart-plus mr-2"></i>{{ $cart == null ? 'Add to cart' : 'Remove from cart' }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
