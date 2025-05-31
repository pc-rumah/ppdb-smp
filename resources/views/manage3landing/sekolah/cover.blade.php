@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Cover</h5>
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
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('sekolah.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="judul_smp" class="form-control"
                                value="{{ $cover->judul_smp ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi_smp" class="form-control" required>{{ $cover->deskripsi_smp ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Cover</label>
                            <input type="file" name="cover_smp" class="form-control">
                            <br>
                            @if (isset($cover->cover_smp))
                                <img src="{{ asset('storage/' . $cover->cover_smp) }}"
                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
