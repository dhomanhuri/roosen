@extends('sbadmin.layout')

@section('main')
    <style>
        .formInput {
            display: flex;
        }

        @media screen and (max-width: 856px) {
            .formInput {
                display: block;
            }
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-center">Hasil Produksi</div>
            <div class="card-body">
                @if ( isset($hasilProduksiEdit) )
                    <form action="{{ route('hasilproduksi.update',$hasilProduksiEdit->id) }}" method="POST">
                        @method('put')
                @else 
                    <form action="{{ route('hasilproduksi.store') }}" method="POST">
                @endif
                    @csrf
                    <div class="col-lg-12 formInput justify-content-center">
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Panen : </label>
                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                name="tanggal_panen"
                                @isset($hasilProduksiEdit)
                                value="{{ $hasilProduksiEdit->tanggal_panen }}"
                            @endisset>
                            @error('tanggal_panen')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Pohon : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah_pohon"
                                @isset($hasilProduksiEdit)
                                value="{{ $hasilProduksiEdit->jumlah_pohon }}"
                            @endisset>
                            @error('jumlah_pohon')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Bunga : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah_bunga"
                                @isset($hasilProduksiEdit)
                                value="{{ $hasilProduksiEdit->jumlah_bunga }}"
                            @endisset>
                            @error('jumlah_bunga')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Ukuran Kelopak : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="ukuran_kelopak"
                                @isset($hasilProduksiEdit)
                                value="{{ $hasilProduksiEdit->ukuran_kelopak }}"
                            @endisset>
                            @error('ukuran_kelopak')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="submit text-center">
                        @isset($hasilProduksiEdit)
                                <a href="/hasilproduksi" class="btn btn-outline-success mb-3">Cancel</a>
                        @endisset
                        <button type="submit" class="btn btn-success mb-3" style="margin-left: 12px;">Save</button>
                    </div>
                </form>
                <div class="table-responsive">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal Panen</th>
                                <th>Jumlah Pohon</th>
                                <th>Jumlah Bunga</th>
                                <th>Ukuran Kelopak</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilproduksi as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tanggal_panen }}</td>
                                    <td>{{ $data->jumlah_pohon }}</td>
                                    <td>{{ $data->jumlah_bunga }}</td>
                                    <td>{{ $data->ukuran_kelopak }}</td>
                                    <td>
                                        <a href="{{ route('hasilproduksi.edit', $data->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('hasilproduksi.destroy', $data->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $hasilproduksi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
