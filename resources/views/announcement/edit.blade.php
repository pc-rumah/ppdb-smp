@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card bg-info bg-gradient">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pengumuman.update', $pengumuman) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        aria-describedby="" value="{{ $pengumuman->judul }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal"
                                        aria-describedby="" value="{{ $pengumuman->tanggal }}">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" aria-describedby="">{{ $pengumuman->deskripsi }}</textarea>
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
