@extends('layouts.layout')

@section('main')
<style>
    footer {
    position: fixed;
    height: 100px;
    bottom: 0;
    width: 100%;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="card">
                <div class="card-header">
                  Cart Anda
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product dari petani</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $user as $c )
                         @if( App\Models\Cart::where('nama_petani',$c->name)->where('user_id',auth()->user()->id)->count() !== 0)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$c->name }}</td>
                            <td>{{ App\Models\Cart::where('nama_petani',$c->name)->where('user_id',auth()->user()->id)->count() }}</td>
                            <td><a href="{{ url('cart/petani/'.$c->name ) }}" class="btn btn-primary">Detail Cart</a></td>
                          </tr>
                          @endif
                          @endforeach
                        </tbody>
                      </table>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection





    



