@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Saudara</h5>
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
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('saudara.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Saudara</label>
                            <input type="text" name="nama" class="form-control" id="nama" aria-describedby=""
                                value="{{ old('nama') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
