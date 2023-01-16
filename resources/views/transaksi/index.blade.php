@extends('sbadmin.layout')

@section('main')
<style>
    .table-petani {
        transform: scale(0.9);
    }
</style>
<div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Daftar Petani</h1>
            </div>
            <div class="col-lg-12 mt-3 table-petani">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <div class="table-responsive rounded-top">
                    <table class="table shadow-sm display-5">
                        <thead>
                            <tr class="text-light bg-success ">
                                <th scope="col">No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Ongkir</th>
                                <th scope="col">Alamat Pembeli</th>
                                <th scope="col">Status</th>
                                <th scope="col">No Hp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($transaksi as $pet)
                                <tr class="text-dark text-center">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>
                                        <ul>
                                        @foreach( $pet->detailtransaksi as $detail)
                                         <li>{{ $detail->nama_produk }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $pet->total_harga }}</td>
                                    <td>{{ $pet->ongkir }}</td>
                                    <td>{{ $pet->alamat_pembeli }}</td>
                                    <td>{{ $pet->status }}</td>
                                    <td>{{ $pet->nohp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


