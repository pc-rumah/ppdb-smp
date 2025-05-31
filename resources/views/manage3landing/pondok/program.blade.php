@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Program</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
