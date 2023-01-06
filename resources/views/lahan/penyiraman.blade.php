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
            <div class="card-header text-center">Penyiraman</div>
            <div class="card-body">
                @if (isset($penyiramanEdit))
                    <form action="{{ route('penyiraman.update', $penyiramanEdit->id) }}" method="POST">
                        @method('put')
                    @else
                        <form action="{{ route('penyiraman.store') }}" method="POST">
                @endif
                @csrf
                <div class="col-lg-12 formInput justify-content-center">
                    <div class="mb-3" style="margin-right: 7px;">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal : </label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal"
                            @isset($penyiramanEdit)
                                value="{{ $penyiramanEdit->tanggal }}"
                            @endisset>
                        @error('tanggal')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3" style="margin-right: 7px;">
                        <label for="exampleFormControlInput1" class="form-label">Volume : </label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="volume"
                            @isset($penyiramanEdit)
                                value="{{ $penyiramanEdit->volume }}"
                            @endisset>
                        @error('volume')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="submit text-center">
                    @isset($penyiramanEdit)
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
                                <th>Tanggal</th>
                                <th>Volume</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyiraman as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->volume }}</td>
                                    <td>
                                        <a href="{{ route('penyiraman.edit', $data->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('penyiraman.destroy', $data->id) }}" method="POST"
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
                    {{ $penyiraman->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
