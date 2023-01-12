@extends('sbadmin.layout')

@section('main')
    <style>
        /* .formPetani {
            transform: scale(0.85);
        } */
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center">
                <h5 class="text-success">Add Product</h5>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
            </div>
            <div class="col-lg-8 formPetani" id="form">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1"
                            name="nama" required>
                        @error('nama')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga ( Ex : 20000 )</label>
                        <input type="harga" class="form-control form-control-sm" id="exampleFormControlInput1"
                            name="harga" required>

                        @error('harga')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Stok</label>
                        <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"
                            name="stok" required>

                        @error('stok')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea2" style="height: 500px" name="keterangan"></textarea>
                        </div>
                        @error('keterangan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p>Path : <span class="path"></span></p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Foto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input upload" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" name="gambar" required>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    @error('gambar')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-success text-center btn-block" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
