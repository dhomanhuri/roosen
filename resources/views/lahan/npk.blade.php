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
            <div class="card-header text-center">NPK</div>
            <div class="card-body">
                @if ( isset($npkEdit) )
                    <form action="{{ route('npk.update',$npkEdit->id) }}" method="POST">
                        @method('put')
                @else 
                    <form action="{{ route('npk.store') }}" method="POST">
                @endif
                    @csrf
                    <div class="col-lg-12 formInput justify-content-center">
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal : </label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="tanggal"
                                name="tanggal"
                                @isset($npkEdit)
                                value="{{ $npkEdit->tanggal }}"
                            @endisset>
                            @error('tanggal')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">N : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="n"
                                @isset($npkEdit)
                                value="{{ $npkEdit->n }}"
                            @endisset>
                            @error('n')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">P : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="p"
                                @isset($npkEdit)
                                value="{{ $npkEdit->p }}"
                            @endisset>
                            @error('p')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-right: 7px;">
                            <label for="exampleFormControlInput1" class="form-label">K : </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="k"
                                @isset($npkEdit)
                                value="{{ $npkEdit->k }}"
                            @endisset>
                            @error('k')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="submit text-center">
                        @isset($npkEdit)
                                <a href="/npk" class="btn btn-outline-success mb-3">Cancel</a>
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
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>N</th>
                                <th class="text-success">Status</th>
                                <th>P</th>
                                <th class="text-success">Status</th>
                                <th>K</th>
                                <th class="text-success">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($npk as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->n }}</td>
                                    <td class="text-success">normal</td>
                                    <td>{{ $data->p }}</td>
                                    <td class="text-success">kurang</td>
                                    <td>{{ $data->k }}</td>
                                    <td class="text-success">lebih</td>
                                    <td>
                                        <a href="{{ route('npk.edit', $data->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('npk.destroy', $data->id) }}" method="POST"
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
                    {{ $npk->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
