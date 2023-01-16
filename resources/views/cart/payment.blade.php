@extends('sbadmin.layout')

@section('main')

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
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

        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');


        .card {
            max-width: 500px;
            margin: auto;
            color: black;
            border-radius: 20 px;
        }

        p {
            margin: 0px;
        }

        .container .h8 {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
        }

    

        .btn.btn.btn-primary:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }



        .btn.btn-primary:hover .fas.fa-arrow-right {
            transform: translate(15px);
            transition: transform 0.2s ease-in;
        }

        .form-control {
            background-color: #223C60;
            border: 2px solid transparent;
            height: 60px;
            padding-left: 20px;
            vertical-align: middle;
        }

        .form-control:focus {
            color: white;
            background-color: #0C4160;
            border: 2px solid #2d4dda;
            box-shadow: none;
        }

        .text {
            font-size: 14px;
            font-weight: 600;
        }

        ::placeholder {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Payment</h2>
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
            <div class="card-body" id="payment">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">

                        <div class="container p-0">
                            <div class="card px-4">
                                <p class="h8 py-3">Payment Details</p>
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">Nama </p>
                                            <input class="form-control mb-3" type="text" value="{{ $hasil->user->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">Alamat</p>
                                            <input class="form-control mb-3" type="text"
                                                value="{{ $hasil->alamat_pembeli }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">Total Harga</p>
                                            <input class="form-control mb-3" type="text"
                                                value="{{ number_format($hasil->total_harga, 2, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">Ongkir</p>
                                            <input class="form-control mb-3" type="text"
                                                value="{{ number_format($hasil->ongkir, 2, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">Total Pembayaran</p>
                                            <input class="form-control mb-3" type="text"
                                                value="{{ number_format($hasil->total_harga + $hasil->ongkir, 2, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <p class="text mb-1">NO HP</p>
                                            <input class="form-control mb-3 pt-2 " type="text"
                                                value="{{ $hasil->nohp }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mb-2">
                                            <button id="pay-button" class="btn btn-success shadow-lg btn-icon-split btn-lg text-center">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Bayar Sekarang</span>
                                            </button>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="btn btn-danger mb-3 shadow-lg">
                                            <form action="{{ route('payment.destroy', $hasil->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="ps-3 text-center text-light btn btn-danger"
                                                    type="submit">Cancel Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </table>
                </div>
                <!-- / Shopping cart table -->

                <script type="text/javascript">
                    // For example trigger on button clicked, or any time you need
                    var payButton = document.getElementById('pay-button');
                    payButton.addEventListener('click', function () {
                      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                      window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                          /* You may add your own implementation here */
                          alert("payment success!"); console.log(result);
                        },
                        onPending: function(result){
                          /* You may add your own implementation here */
                          alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                          /* You may add your own implementation here */
                          alert("payment failed!"); console.log(result);
                        },
                        onClose: function(){
                          /* You may add your own implementation here */
                          alert('you closed the popup without finishing the payment');
                        }
                      })
                    });
                  </script>
            @endsection
