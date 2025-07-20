@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Data Prestasi</h5>
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
                    <form action="{{ route('prestasi.update', $data) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Juara</label>
                            <input type="text" class="form-control" name="juara" value="{{ $data->juara }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" value="{{ $data->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">SubJudul</label>
                            <input type="text" class="form-control" name="subjudul" value="{{ $data->subjudul }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto (PNG/JPG)</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                            <br>
                            @if (isset($data->foto))
                                <img src="{{ asset('storage/' . $data->foto) }}" style="max-width: 200px; display: block;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
