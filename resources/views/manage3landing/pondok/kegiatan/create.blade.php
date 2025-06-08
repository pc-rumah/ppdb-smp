@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Kegiatan Pondok</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kegiatanpondok.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Waktu</label>
                            <input type="time" class="form-control" name="time" value="{{ old('time') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
