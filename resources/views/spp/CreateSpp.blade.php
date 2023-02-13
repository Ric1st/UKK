<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

@if($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header">
                        <h1>Tambah Data SPP</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('spp.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <label class="font-weight-bold mr-3">NIS : </label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{Session::get('nis')}}" placeholder="Masukkan NIS Anda">
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <label class="font-weight-bold mr-3">Nama : </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{Session::get('nama')}}" placeholder="Masukkan Nama Lengkap Anda">
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <label class="font-weight-bold mr-3">Nominal Pembayaran : </label>
                                <span class="input-group-text ml-3">Rp</span>
                                <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{Session::get('nominal')}}" placeholder="Masukkan Nominal Pembayaran Anda">
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>


                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <a href="{{route('spp.index')}}" class="btn btn-danger">Kembali</a>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>