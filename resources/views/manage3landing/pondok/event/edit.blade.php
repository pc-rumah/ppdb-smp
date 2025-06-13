@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card bg-info bg-gradient">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Forms Update</h5>
                    @include('layouts.semuaalert')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('eventpondok.update', $eventpondok) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control"
                                        value="{{ old('judul', $eventpondok->judul) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control"
                                        value="{{ old('lokasi', $eventpondok->lokasi) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ old('tanggal', $eventpondok->tanggal) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai" class="form-control"
                                        value="{{ $eventpondok->waktu_mulai }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilih jenis waktu selesai</label>
                                    <div>
                                        <input type="radio" id="waktuRadio" name="waktu_type" value="waktu" checked>
                                        <label for="waktuRadio">Waktu (misal 10:25)</label><br>
                                        <input type="radio" id="selesaiRadio" name="waktu_type" value="selesai">
                                        <label for="selesaiRadio">Selesai</label>
                                    </div>
                                </div>

                                <div class="mb-3" id="inputWaktu">
                                    <label for="waktu_selesai_time" class="form-label">Masukkan Waktu Selesai</label>
                                    <input type="time" name="waktu_selesai_time" class="form-control">
                                </div>

                                <div class="mb-3 d-none" id="inputSelesai">
                                    <label for="waktu_selesai_text" class="form-label">Ketik "selesai"</label>
                                    <input type="text" name="waktu_selesai_text" class="form-control" value="selesai">
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $eventpondok->deskripsi) }}</textarea>
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
