@extends('sbadmin.layout')

@section('main')

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <h1>Hello <span class="text-danger"> {{ auth()->user()->name }}</span></h1>
            </div>
        </div>
    </div>

@endsection