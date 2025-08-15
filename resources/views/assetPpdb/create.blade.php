@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Asset Bukti Pendaftaran</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('assetbukti.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kontak_1" class="form-label">Nama Kontak 1</label>
                            <input type="text" name="nama_kontak_1" id="nama_kontak_1" class="form-control"
                                value="{{ old('nama_kontak_1', isset($data) ? $data->nama_kontak_1 : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nomor_kontak_1" class="form-label">Nomor Kontak 1</label>
                            <input type="text" name="nomor_kontak_1" id="nomor_kontak_1" class="form-control"
                                value="{{ old('nomor_kontak_1', isset($data) ? $data->nomor_kontak_1 : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_kontak_2" class="form-label">Nama Kontak 2</label>
                            <input type="text" name="nama_kontak_2" id="nama_kontak_2" class="form-control"
                                value="{{ old('nama_kontak_2', isset($data) ? $data->nama_kontak_2 : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nomor_kontak_2" class="form-label">Nomor Kontak 2</label>
                            <input type="text" name="nomor_kontak_2" id="nomor_kontak_2" class="form-control"
                                value="{{ old('nomor_kontak_2', isset($data) ? $data->nomor_kontak_2 : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ketua_panitia" class="form-label">Ketua Panitia</label>
                            <input type="text" name="ketua_panitia" id="ketua_panitia" class="form-control"
                                value="{{ old('ketua_panitia', isset($data) ? $data->ketua_panitia : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_ajar" class="form-label">Tahun Ajar</label>
                            <input type="text" name="tahun_ajar" id="tahun_ajar" class="form-control"
                                value="{{ old('tahun_ajar', isset($data) ? $data->tahun_ajar : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="logo_pondok_kiri" class="form-label">Logo Kiri</label>
                            <input type="file" name="logo_pondok_kiri" class="form-control" id="logo_pondok_kiri"><br>

                            @if (isset($data->logo_pondok_kiri))
                                <img class="gambarPreview" src="{{ asset('storage/' . $data->logo_pondok_kiri) }}">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="logo_pondok_kanan" class="form-label">Logo Kanan</label>
                            <input type="file" name="logo_pondok_kanan" class="form-control" id="logo_pondok_kanan"><br>

                            @if (isset($data->logo_pondok_kanan))
                                <img class="gambarPreview" src="{{ asset('storage/' . $data->logo_pondok_kanan) }}">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="tanda_tangan" class="form-label">Tanda Tangan</label>
                            <input type="file" name="tanda_tangan" class="form-control" id="tanda_tangan"><br>

                            @if (isset($data->tanda_tangan))
                                <img class="gambarPreview" src="{{ asset('storage/' . $data->tanda_tangan) }}">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
