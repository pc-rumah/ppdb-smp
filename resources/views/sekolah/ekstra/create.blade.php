@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Ekstrakurikuler</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ekstra.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
