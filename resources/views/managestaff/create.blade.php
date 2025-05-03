@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card bg-info bg-gradient">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tambah Data</h5>
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
                            <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        aria-describedby="" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input type="text" name="position" class="form-control" id="position"
                                        aria-describedby="" value="{{ old('position') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea type="text" name="description" class="form-control" id="description" aria-describedby="">{{ old('description') }}</textarea>
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
