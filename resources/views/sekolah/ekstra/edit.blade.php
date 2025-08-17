@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Data Ekstrakurikuler</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ekstra.update', $data) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" value="{{ $data->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*" required>
                            @isset($data->gambar)
                                <img style="max-width: 40%" src="{{ asset('storage/' . $data->gambar) }}">
                            @endisset
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
