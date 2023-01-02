@extends('sbadmin.layout')

@section('main')

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <h1>Welcome <span class="text-success"> {{ auth()->user()->name }}</span></h1>
            </div>
        </div>
    </div>

@endsection