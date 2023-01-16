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
                    <form action="{{ route('cart.update', $cartEdit->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-lg-2 formInput">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Quantity : </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="qty"
                                    @isset($cartEdit)
                                value="{{ $cartEdit->qty }}"
                            @endisset
                                    min="1">
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
                <div class="d-flex flex-wrap justify-content-end align-items-center pb-4">
                    <div class="d-flex">
                        <div class="text-right mt-1">
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
                    {{-- Chekcout button  --}}
                    @if( !empty(auth()->user()->cart) )
                    <button type="button" class="btn btn-lg btn-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Checkout
                    </button>
                    @else 
                    <button type="button" class="btn btn-lg btn-primary mt-2 data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Cart Anda kosong
                    </button>
                    @endif

                    <!-- Modal Checkout -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel"><i class="fas fa-money-check text-primary"></i> Checkout</h1>
                                    <button type="button" class="btn btn-close btn-danger shadow" data-bs-dismiss="modal"
                                        aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payment.store') }}#payment" method="POST">
                                        @csrf
                                        <input type="hidden" name="total_harga" value="{{ $totalBiaya }}">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label text-dark">No HP</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="nohp" required>
                                        </div>
                                        <div class="form-floating">
                                            <label for="exampleInputEmail1" class="form-label text-dark">Alamat</label>
                                            <textarea class="form-control" placeholder="Masukkan alamat anda" name="alamat_pembeli" id="floatingTextarea2" style="height: 100px"></textarea>
                                          </div>
                                          <div class="container-fluid mt-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3>CEK ONGKIR</h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">PROVINSI ASAL</label>
                                                                <select class="form-control provinsi-asal" name="province_origin">
                                                                    <option value="0">-- pilih provinsi asal --</option>
                                                                    @foreach ($provinces as $province => $value)
                                                                        <option value="{{ $province  }}">{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                                                                <select class="form-control kota-asal" name="city_origin">
                                                                    <option value="">-- pilih kota asal --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3>DESTINATION</h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">PROVINSI TUJUAN</label>
                                                                <select class="form-control provinsi-tujuan" name="province_destination">
                                                                    <option value="0">-- pilih provinsi tujuan --</option>
                                                                    @foreach ($provinces as $province => $value)
                                                                        <option value="{{ $province  }}">{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                                                                <select class="form-control kota-tujuan" name="city_destination">
                                                                    <option value="">-- pilih kota tujuan --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="card d-none ongkir">
                                                        <div class="card-body">
                                                            <ul class="list-group" id="ongkir"></ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                //active select2
                $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                    theme: 'bootstrap4',
                    width: 'style',
                });
                //ajax select kota asal
                $('select[name="province_origin"]').on('change', function() {
                    let provindeId = $(this).val();
                    if (provindeId) {
                        jQuery.ajax({
                            url: '/cities/' + provindeId,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="city_origin"]').empty();
                                $('select[name="city_origin"]').append(
                                    '<option value="">-- pilih kota asal --</option>');
                                $.each(response, function(key, value) {
                                    $('select[name="city_origin"]').append(
                                        '<option value="' + key + '">' + value +
                                        '</option>');
                                });
                            },
                        });
                    } else {
                        $('select[name="city_origin"]').append(
                            '<option value="">-- pilih kota asal --</option>');
                    }
                });
                //ajax select kota tujuan
                $('select[name="province_destination"]').on('change', function() {
                    let provindeId = $(this).val();
                    if (provindeId) {
                        jQuery.ajax({
                            url: '/cities/' + provindeId,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="city_destination"]').empty();
                                $('select[name="city_destination"]').append(
                                    '<option value="">-- pilih kota tujuan --</option>');
                                $.each(response, function(key, value) {
                                    $('select[name="city_destination"]').append(
                                        '<option value="' + key + '">' + value +
                                        '</option>');
                                });
                            },
                        });
                    } else {
                        $('select[name="city_destination"]').append(
                            '<option value="">-- pilih kota tujuan --</option>');
                    }
                });
                //ajax check ongkir
                let isProcessing = false;
                $('.btn-check').click(function(e) {
                    e.preventDefault();

                    let token = $("meta[name='csrf-token']").attr("content");
                    let city_origin = $('select[name=city_origin]').val();
                    let city_destination = $('select[name=city_destination]').val();
                    let courier = $('select[name=courier]').val();
                    let weight = $('#weight').val();

                    if (isProcessing) {
                        return;
                    }

                    isProcessing = true;
                    jQuery.ajax({
                        url: "/ongkir",
                        data: {
                            _token: token,
                            city_origin: city_origin,
                            city_destination: city_destination,
                            courier: courier,
                            weight: weight,
                        },
                        dataType: "JSON",
                        type: "POST",
                        success: function(response) {
                            isProcessing = false;
                            if (response) {
                                $('#ongkir').empty();
                                $('.ongkir').addClass('d-block');
                                $.each(response[0]['costs'], function(key, value) {
                                    $('#ongkir').append('<li class="list-group-item">' +
                                        response[0].code.toUpperCase() + ' : <strong>' +
                                        value.service + '</strong> - Rp. ' + value.cost[
                                            0].value + ' (' + value.cost[0].etd +
                                        ' hari)</li>')
                                });

                            }
                        }
                    });

                });

            });
        </script>

@endsection
