@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Program</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('programmadrasah.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Program</label>
                            <input type="text" name="nama" class="form-control" id="nama" aria-describedby=""
                                value="{{ old('nama') }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea type="text" name="description" class="form-control" id="description" aria-describedby="">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Pilih Icon</label>
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#iconPickerModal">
                                    Pilih Icon
                                </button>
                                <input type="hidden" name="icon" id="iconInput" value="{{ old('icon') }}">
                                <i id="iconPreview" class="{{ old('icon') }}" style="font-size: 1.5rem;"></i>
                            </div>
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
