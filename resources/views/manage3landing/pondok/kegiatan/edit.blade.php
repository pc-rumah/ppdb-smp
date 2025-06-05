@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Data Kegiatan</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kegiatanpondok.update', $data) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="image">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small><br>
                            @if ($data->image)
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Gambar Sebelumnya"
                                    class="img-thumbnail mb-2" style="max-height: 150px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="title" value="{{ $data->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Waktu</label>
                            <input type="time" class="form-control" name="time" value="{{ $data->time }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required>{{ $data->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
