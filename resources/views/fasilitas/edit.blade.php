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
                            <form action="{{ route('fasilitas.update', $fasilitas) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="unit_id" class="form-label">Nama Unit</label>
                                    <select class="form-select" name="unit_id" aria-label="Default select example">
                                        <option value="{{ $fasilitas->unit_id }}" selected>{{ $fasilitas->unit->judul }}
                                        </option>
                                        @foreach ($unit as $item)
                                            <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Fasilitas</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        aria-describedby="" value="{{ $fasilitas->name }}" required>
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
