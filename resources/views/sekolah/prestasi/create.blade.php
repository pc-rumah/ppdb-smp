@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Prestasi</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Juara -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Juara</label>
                            <input type="text" class="form-control" name="juara" value="{{ old('juara') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">SubJudul</label>
                            <input type="text" class="form-control" name="subjudul" value="{{ old('subjudul') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto (PNG/JPG)</label>
                            <input type="file" class="form-control" name="foto" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
