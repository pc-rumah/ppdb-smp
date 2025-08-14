@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Prestasi</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('prestasimadrasah.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="gelar" class="form-label">Gelar</label>
                            <input type="text" name="gelar" class="form-control" id="gelar"
                                value="{{ old('gelar') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kegiatan" class="form-label">Nama</label>
                            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan"
                                value="{{ old('nama_kegiatan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <input type="text" name="tingkat" class="form-control" id="tingkat"
                                value="{{ old('tingkat') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" accept="image/*"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
