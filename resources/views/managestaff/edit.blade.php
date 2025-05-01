@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Edit</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('staff.update', $data) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        aria-describedby="" value="{{ $data->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input type="text" name="position" class="form-control" id="position"
                                        aria-describedby="" value="{{ $data->position }}">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <br>
                                    @if (isset($data->image))
                                        <img src="{{ asset('storage/' . $data->image) }}"
                                            style="max-width: 200px; display: block; margin-bottom: 10px;">
                                    @endif
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
