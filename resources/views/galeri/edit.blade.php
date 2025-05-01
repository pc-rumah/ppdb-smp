@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card bg-info bg-gradient">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Update Data Galeri</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('galeri.update', $galeri) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        aria-describedby="" value="{{ $galeri->judul }}">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control" id="gambar"
                                        aria-describedby="">
                                    <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Gambar"
                                        class="img-fluid mt-2" style="max-width: 200px;">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" aria-describedby="">{{ $galeri->deskripsi }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
