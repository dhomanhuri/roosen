@extends('sbadmin.layout')

@section('main')
    <style>
        .ui-w-40 {
            width: 40px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
        }

        input[readonly].form-control {
            background-color: transparent;
            border: 0;
            font-size: 1em;
        }
    </style>
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success mx-3 mt-1">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger mx-3 mt-1">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <div class="card-body">
                @isset($cartEdit)
                    <form action="{{ route('cart.update',$cartEdit->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-lg-2 formInput">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Quantity : </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="qty"
                                    @isset($cartEdit)
                                value="{{ $cartEdit->qty }}"
                            @endisset>
                                @error('qty')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="submit">
                                    @isset($pemupukanEdit)
                                        <a href="/penyiraman" class="btn btn-outline-success mb-3">Cancel</a>
                                    @endisset
                                    <button type="submit" class="btn btn-success mt-3">Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endisset
                {{ $cart->links() }}
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <!-- Set columns width -->
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Harga</th>
                                <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#"
                                        class="shop-tooltip float-none text-light" title=""
                                        data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cart as $c)
                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('storage/' . $c->product->gambar) }}"
                                                class="d-block ui-w-40 ui-bordered mr-4 img-thumbnail shadow"
                                                alt="">
                                            <div class="media-body">
                                                <a href="{{ url('product/' . $c->product->id) }}"
                                                    class="d-block text-dark">{{ $c->product->nama }}</a>
                                                <small>
                                                    <span class="text-muted">Stok :</span>
                                                    <span class="text-danger">{{ $c->product->stok }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">
                                        {{ number_format($c->product->harga, 2, ',', '.') }}
                                    </td>
                                    <td class="align-middle p-4 text-center">
                                        <div class="d-flex justify-content-around">
                                            {{ $c->qty }}
                                            <a href="{{ route('cart.edit', $c->id) }}"><i class="fas fa-pen"></i></a>
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">
                                        {{ number_format($c->product->harga * $c->qty, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center align-middle px-0">
                                        <form action="{{ route('cart.destroy', $c->product->id, Request::url()) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="shop-tooltip close float-none text-danger"
                                                title="" data-original-title="Remove">×</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $cart->links() }}
                    </div>
                </div>
                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-end align-items-center pb-4">
                    <div class="d-flex">
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">Total price</label>
                            <div class="text-large"><strong>Rp . {{ number_format($totalBiaya, 2, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right">
                    <a href="{{ url('/product/all') }}" class="btn btn-lg btn-outline-primary md-btn-flat mt-2 mr-3">Back
                        to
                        shopping</a>
                    <button type="button" class="btn btn-lg btn-primary mt-2">Checkout</button>
                </div>

            </div>
        </div>
    </div>
@endsection
