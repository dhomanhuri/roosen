@extends('sbadmin.layout')

@section('main')
<style>
    .formPetani {
        transform: scale(0.85);
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center">
                <h5 class="text-success">Edit Petani</h5>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                    </div>
                @endif
            </div>
            <div class="col-lg-8 formPetani" id="formPetani">
                <form action="{{ route('petani.update',$petani->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" 
                            name="name" required value="{{ $petani->name }}">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1"
                            name="email" required value="{{ $petani->email }}">

                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm" id="exampleFormControlInput1" name="password" placeholder="Kosongkan password jika tidak ingin diganti">

                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Alamat Rumah</label>
                        <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" name="alamat_rumah" required value="{{ $petani->alamat_rumah }}">

                        @error('alamat_rumah')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Alamat Lahan</label>
                        <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" name="alamat_lahan" required value="{{ $petani->alamat_lahan }}">

                        @error('alamat_lahan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Luas Lahan</label>
                        <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1" name="luas_lahan" required value="{{ $petani->luas_lahan }}">

                        @error('luas_lahan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Tanaman</label>
                        <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" name="jenis_tanaman" required value="{{ $petani->jenis_tanaman }}">

                        @error('jenis_tanaman')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <img src="{{ asset('storage/'.$petani->foto) }}" alt="" width="200" class="img-thumbnail text-center mb-2 shadow-sm">
                    <p>Path : <span class="path"></span></p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Foto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input upload" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" name="foto" >
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    @error('foto')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-success text-center btn-block" type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
