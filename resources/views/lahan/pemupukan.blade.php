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
            <div class="card-header text-center">Pemupukan</div>
            <div class="card-body">
                @if (isset($pemupukanEdit))
                    <form action="{{ route('pemupukan.update', $pemupukanEdit->id) }}" method="POST">
                        @method('put')
                    @else
                        <form action="{{ route('pemupukan.store') }}" method="POST">
                @endif
                @csrf
                <div class="col-lg-12 formInput justify-content-center">
                    <div class="mb-3" style="margin-right: 7px;">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Pemupukan : </label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_pemupukan"
                            @isset($pemupukanEdit)
                                value="{{ $pemupukanEdit->tanggal_pemupukan }}"
                            @endisset>
                        @error('tanggal_pemupukan')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3" style="margin-right: 7px;">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Pupuk : </label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="jenis_pupuk"
                            @isset($pemupukanEdit)
                                value="{{ $pemupukanEdit->jenis_pupuk }}"
                            @endisset>
                        @error('jenis_pupuk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3" style="margin-right: 7px;">
                        <label for="exampleFormControlInput1" class="form-label">Volume Pupuk : </label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="volume_pupuk"
                            @isset($pemupukanEdit)
                                value="{{ $pemupukanEdit->volume_pupuk }}"
                            @endisset>
                        @error('volume_pupuk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="submit text-center">
                    @isset($pemupukanEdit)
                        <a href="/penyiraman" class="btn btn-outline-success mb-3">Cancel</a>
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
                                <th>Tanggal Pemupukan</th>
                                <th>Jenis Pupuk</th>
                                <th>Volume Pupuk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemupukan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tanggal_pemupukan }}</td>
                                    <td>{{ $data->jenis_pupuk }}</td>
                                    <td>{{ $data->volume_pupuk }}</td>
                                    <td>
                                        <a href="{{ route('pemupukan.edit', $data->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('pemupukan.destroy', $data->id) }}" method="POST"
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
                    {{ $pemupukan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
