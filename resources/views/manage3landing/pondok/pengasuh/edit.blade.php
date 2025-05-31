@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Pengasuh</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengasuh.update', $data) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto"><br>
                            @if ($data->foto)
                                <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Pengasuh" width="150"
                                    class="mb-2 rounded">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" required>{{ $data->deskripsi }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
