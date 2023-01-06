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
            <div class="card-header text-center">PH TANAH</div>
            <div class="card-body">
                @if ( isset($phTanahEdit) )
                    <form action="{{ route('phtanah.update',$phTanahEdit->id) }}" method="POST">
                        @method('put')
                @else 
                    <form action="{{ route('phtanah.store') }}" method="POST">
                @endif
                    @csrf
                    <div class="col-lg-12 formInput justify-content-center">
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Sebar : </label>
                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                name="tanggal_sebar"
                                @isset($phTanahEdit)
                                value="{{ $phTanahEdit->tanggal_sebar }}"
                            @endisset>
                            @error('tanggal_sebar')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Volume Dolomit : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="volume_dolomit"
                                @isset($phTanahEdit)
                                value="{{ $phTanahEdit->volume_dolomit }}"
                            @endisset>
                            @error('volume_dolomit')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Pengukuran : </label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_pengukuran"
                                @isset($phTanahEdit)
                                value="{{ $phTanahEdit->tanggal_pengukuran }}"
                            @endisset>
                            @error('tanggal_pengukuran')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">PH : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="ph"
                                @isset($phTanahEdit)
                                value="{{ $phTanahEdit->ph }}"
                            @endisset>
                            @error('ph')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="submit text-center">
                        @isset($phTanahEdit)
                                <a href="/phtanah" class="btn btn-outline-success mb-3">Cancel</a>
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
                                <th>Tanggal Sebar</th>
                                <th>Volume Dolomit</th>
                                <th>Tanggal Pengukuran</th>
                                <th>PH</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phtanah as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tanggal_sebar }}</td>
                                    <td>{{ $data->volume_dolomit }}</td>
                                    <td>{{ $data->tanggal_pengukuran }}</td>
                                    <td>{{ $data->ph }}</td>
                                    <td>
                                        <a href="{{ route('phtanah.edit', $data->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('phtanah.destroy', $data->id) }}" method="POST"
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
                    {{ $phtanah->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
