@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Cover</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('madrasah.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="judul_madrasah" class="form-control"
                                value="{{ $cover->judul_madrasah ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi_madrasah" class="form-control" required>{{ $cover->deskripsi_madrasah ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Cover</label>
                            <input type="file" name="cover_madrasah" class="form-control">
                            <br>
                            @if (isset($cover->cover_madrasah))
                                <img src="{{ asset('storage/' . $cover->cover_madrasah) }}"
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
