@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Cover</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pondok.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="judul_pondok" class="form-control"
                                value="{{ $cover->judul_pondok ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi_pondok" class="form-control" required>{{ $cover->deskripsi_pondok ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Cover</label>
                            <input type="file" name="cover_pondok" class="form-control" required>
                            <br>
                            @if (isset($cover->cover_pondok))
                                <img src="{{ asset('storage/' . $cover->cover_pondok) }}"
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
