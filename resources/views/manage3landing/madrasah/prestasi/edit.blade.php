@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Data Prestasi</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('prestasimadrasah.update', $data->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="gelar" class="form-label">Gelar</label>
                            <input type="text" name="gelar" class="form-control" id="gelar"
                                value="{{ $data->gelar }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan"
                                value="{{ $data->nama_kegiatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <input type="text" name="tingkat" class="form-control" id="tingkat"
                                value="{{ $data->tingkat }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" accept="image/*"> <br>

                            @if (isset($data->gambar))
                                <img src="{{ asset('storage/' . $data->gambar) }}" style="max-width: 200px; display:block;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="iconPickerModal" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pilih Ikon</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="text" class="form-control mb-3" id="iconSearch"
                                        placeholder="Cari ikon...">
                                    <div class="row row-cols-6 g-3" id="iconList">
                                        <!-- icons go here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
