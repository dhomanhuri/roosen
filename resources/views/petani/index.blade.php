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
                    <table class="table shadow-sm">
                        <thead>
                            <tr class="table-success text-dark">
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alamat Rumah</th>
                                <th scope="col">Alamat Lahan</th>
                                <th scope="col">Luas Lahan</th>
                                <th scope="col">Jenis Tanaman</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($petani as $pet)
                                <tr class="text-dark text-center">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $pet->name }}</td>
                                    <td>{{ $pet->email }}</td>
                                    <td>{{ $pet->alamat_rumah }}</td>
                                    <td>{{ $pet->alamat_lahan }}</td>
                                    <td>{{ $pet->luas_lahan }}</td>
                                    <td>{{ $pet->jenis_tanaman }}</td>
                                    <td>
                                        <a href="{{ route('petani.edit',$pet->id) }}#formPetani" class="btn btn-outline-success">edit</a>
                                        <form action="{{ route('petani.destroy',$pet->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
