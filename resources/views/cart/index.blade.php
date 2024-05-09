@extends('layouts.layout')

@section('main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <a href="/cart" class="btn btn-danger mb-3">Back</a>
                            <tr class="table_head">
                                <th class="column-1">Gambar</th>
                                <th class="column-2">Nama</th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-5">Action</th>
                            </tr>
                            @foreach( $cart as $c )
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('storage/'.$c->product->gambar) }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $c->product->nama }}</td>
                                <td class="column-3">{{ number_format($c->product->harga,2,',','.') }}</td>
                                <td class="column-4 text-center">
                                        {{$c->qty}}
                                </td>
                                <td class="column-5">{{ number_format($c->product->harga * $c->qty,2,',','.') }}</td>
                                <td class="column-6">
                                    <form action="{{ route('cart.destroy', $c->product->id, Request::url()) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" value="{{ $c->user->nama_petani }}" name="nama_petani">
                                        <button type="submit" class="shop-tooltip close float-none text-danger"
                                            title="" data-original-title="Remove">X</button>
                                    </form>
                                </td>
                            </tr>   
                            @endforeach
                            {{ $cart->links() }}
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Total Harga
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                @php
                                    $harga = 0;
                                @endphp
                                @foreach( $cart as $c )
                                    @php
                                        $harga += $c->product->harga * $c->qty;
                                    @endphp
                                @endforeach
                                Rp . {{ number_format($harga,2,',','.') }}
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                
                            </span>
                        </div>
                    </div>

                    @if ( $cart->count() !== 0 )
                    <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{ url('checkout/cart/'.$nama) }}">
                        Checkout
                    </a>
                    @else 
                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Cart anda kosong
                    </button>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection





    



