@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Manage Data Kepala Sekolah</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('kepsek.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby=""
                                value="{{ $kepsek->nama_kepsek ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea type="text" name="description" class="form-control" id="description" aria-describedby="">{{ $kepsek->description_kepsek ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
