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
                <h1>My Product</h1>
            </div>
            <div class="col-lg-12 mt-3 table-petani">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
               
                <a href="{{ route('product.create') }}#form" class="btn btn-outline-success mb-3"><i class="fas fa-plus-circle"></i> Add Product</a>
                <form action="{{ route('product.search.dashboard') }}" method="GET">
                <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="CARI PRODUCT" name="keyword" value="{{ request('keyword') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-danger" id="basic-addon2" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                {{ $product->links() }}
                <div class="table-responsive rounded-top">
                    <table class="table shadow-sm display-5">
                        <thead>
                            <tr class="text-light bg-success text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($product as $pet)
                                <tr class="text-dark text-center">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $pet->nama }}</td>
                                    <td>{{ $pet->harga }}</td>
                                    <td>{{ $pet->stok }}</td>
                                    <td>{{ Str::limit($pet->keterangan, 50) }}</td>
                                    <td><img src="{{ asset('storage/'.$pet->gambar) }}" alt="" width="200" class="img-thumbnail"></td>
                                    <td>
                                        <a href="{{ route('product.edit',$pet->id) }}#formPetani" class="btn btn-outline-success">edit</a>
                                        <form action="{{ route('product.destroy',$pet->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $product->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
