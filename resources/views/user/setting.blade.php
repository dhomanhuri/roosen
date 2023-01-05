@extends('sbadmin.layout')

@section('main')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <h1 class="text-success">Settings</h1>
            </div>
            <div class="col-lg-12">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                    </div>
                @endif
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}"
                            name="name">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->email }}"
                            name="email">

                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password ( Kosongkan jika tidak ingin
                            diganti )</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">

                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="" width="300" class="img-thumbnail">
                    <p>Path : <span class="path"></span></p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Foto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input upload" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" name="foto">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    @error('foto')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-success text-center btn-block" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
