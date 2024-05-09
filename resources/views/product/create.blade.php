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
                        <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"
                            name="harga" required min="500">

                        @error('harga')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Stok</label>
                        <input type="number" class="form-control form-control-sm" min="1"
                            id="exampleFormControlInput1" name="stok" required>

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
                    <img id="blah" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANgAAADpCAMAAABx2AnXAAAAllBMVEXv8PL6+/0REiSAiZAAAAD9/v/W19ru7/H09fd0f4V5g4rS1tnBxcmxt7t2gInn6euNlpsLDCAAABcAABqjqa4AABMAABjM0NSFjZQMDiCNjZWUlJoTFCZtbnYnKDciIzGcnKAvLzt+f4eCgopBQUxzc3sAAB8AAAxgYWs3OERXV2IbHS3Gys6tsrbc3+JKSlRnaHFNUFlcccasAAAE3ElEQVR4nO3cCXeiSBSGYQcYgkYbyxKNVSyyRZYk6P//cwMurSZo2nhabznfm8R2Oenm8RbgMTnd+edB69x7A/5WgKkWYKoFmGoBplqAqRZgqgWYagGmWoCpFmCqBZhq/Q9hVkeBrB/A7r3NfxZggBEJMMCIBBhgRAIMMCIBBhiRAAOMSIABRiTAACMSYIARCTDAiAQYYEQCDDAiAQYYkQADjEiAAUYkwAAjEmCAEQkwwIh0E5h1dSRh1nRwdc8EYdbgV+/XtXUHlw7tBhPr6v1rG+jdS//Vvw+zu8Ord7LOsGtThD1d+C1fegLsd4AB9jnAzqQ4zHr6sDutJ2K1YVb/pdcbvrXJlIbVL730utYXT0rDPnr6ul4LQWWYNdjB+l9HpjRsrG9h7w8Ge9SJPew+Vo+suz4qtgxMbVjHmg51ffj8cOex5j0f225/30Zx2OkA23cnmHnZm06qwKxxb3qRTBFY7dJ/XSRTBDZuTsUXzUwJmDXevMQ4K7OPHSrAdi793Gq0X46fDBVgv11nZma/6L3hoYQ+zDpwnZJZtat+7PDpIA87dp1YjWvXsYw67LOrbWbW1lW3X43EYV9dLbK962BmtGFtri+yA9eBjDas1fVpPzty7VcjZVj7vD7N7LNrd9QnDDvt2susL67daiQMO+PS9e5G1uLaysjCzs1rN7O2ee1WI1XYd6617ISrrp4ZUdi3rvrY+HbS1cyMJuxb1Xrrzz04VBj2TYABBhhgjwKzvj+J/UE9gr+v+Kz3rk5v/enSnWGW/Xx19sW/FXwD2H0CDDAiAQYYkQADjEiAAUYkwAAjEmCAEQkwwIgEGGBEAgwwIgEGGJEAA4xIgAFGJMAAIxJggBEJMMCIBBhgRAIMMCIBBhiRfgJ7UqCfwK7/L8Nv0Q9gigeYagGmWoCpFmCqBZhqAaZagKkWYKoFmGoBplqAqVbn3wetYz5oHeNB62gPGmCqtYWx7Zd28Kemca6x/a3mGt/fJN4GNsuZxvxyfZ2F7uah2agonDDfUdyKaUERzu6wkT9pA+PLjI/EyBlpE8cQJXOcCXOMcV06NxzDYMwwwqlh5CIhNrKTz/MGxkrhBFEkYyOSaSRDKdNqvjJXhuHZhTSnfmKaVT8x/SS/JazeD5i23RsYm+1vbe5pPl3GWfO5vuB8xrh7CNMc6S69dJR6S8OIX4VrpGmxSKYfkSf9qZG993PDt83mL7ihy03DrN5wP3fLegcRWc59zgKPudxnAXMDl62SeCnyVCYyKeeuzFIRxgU/hPGsEIXMllHCHcHmi9EyrvjCeDUjWQ2MfPC2cEJ7Gtx2HY7itHoX9XZVIhIrUY1XaRQVMl5kaRbF81h4HouzLCllNq6yeT725ux9nk4OYRobR6Vgvi9ZkGVe5spixeeeeEvM0Ez7qRxEyVtlLm4KY9V7KKt5EhWxiNylFJknRBWLMsrSVMqkSNNyKZfFPJfRKh5E9Z1RGs+dIxj3Ah6KlPkidZbGUgRhyFYymjhZ9SozZ1EvSc9Ib33oKHkYsIT5YRnMkrIsE64lQRlOEi3X/LIMfZbwJE8Kt15ovtM86oSBdgRrzlBsUp+3RlyrP0bN3sSdSXM/c+pVyx3Gb38Wq7dp1lyw+uhXX9sePHYf2+tse4zZXrBPsEcLMNV6WNh/8aby8QlaAncAAAAASUVORK5CYII=" alt="your image" class="img-thumbnail" width="200">
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
    <script>
        const gambar = document.getElementById("inputGroupFile01");
        const img = document.getElementById("blah");
        gambar.addEventListener('change',function(){
            const [file] = gambar.files;
            if ( file ){
                img.src = URL.createObjectURL(file); 
            }
        });
    </script>
@endsection
