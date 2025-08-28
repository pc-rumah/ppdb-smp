@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Buka / Tutup PPDB</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('jadwal.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai"
                                aria-describedby="" value="{{ $data?->tanggal_mulai ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai"
                                aria-describedby="" value="{{ $data?->tanggal_selesai ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
