@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card bg-info bg-gradient">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pengumumanpondok.update', $pengumumanpondok) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        value="{{ $pengumumanpondok->judul }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal"
                                        value="{{ $pengumumanpondok->tanggal }}">
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="deskripsi">{{ $pengumumanpondok->deskripsi }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar (opsional)</label>
                                    <input type="file" name="gambar" class="form-control" id="gambar">
                                    @if ($pengumumanpondok->gambar)
                                        <div class="mt-2">
                                            <p>Gambar saat ini:</p>
                                            <img src="{{ asset('storage/' . $pengumumanpondok->gambar) }}" alt="Gambar"
                                                style="width: 120px; height: auto; border-radius: 4px;">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
