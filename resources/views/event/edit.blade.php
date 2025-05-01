@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Forms</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('event.update', $event->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control"
                                        value="{{ old('judul', $event->judul) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control"
                                        value="{{ old('lokasi', $event->lokasi) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ old('tanggal', $event->tanggal) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai" class="form-control"
                                        value="{{ old('waktu_mulai', $event->waktu_mulai) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="text" name="waktu_selesai" class="form-control"
                                        value="{{ old('waktu_selesai', $event->waktu_selesai) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
