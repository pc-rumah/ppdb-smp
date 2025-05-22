@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Manage Konten Landing</h5>
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
                    <form method="POST" action="{{ route('manage.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Carousel --}}
                        <h4>Carousel</h4>
                        <div class="mb-3">
                            <label class="form-label">Title 1</label>
                            <input type="text" name="title1" class="form-control" value="{{ $welcome->title1 ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description 1</label>
                            <textarea name="description1" class="form-control">{{ $welcome->description1 ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image 1</label>
                            <input type="file" name="image1" class="form-control"><br>
                            @if (isset($welcome->image1))
                                <img src="{{ asset('storage/' . $welcome->image1) }}"
                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title 2</label>
                            <input type="text" name="title2" class="form-control" value="{{ $welcome->title2 ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description 2</label>
                            <textarea name="description2" class="form-control">{{ $welcome->description2 ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image 2</label>
                            <input type="file" name="image2" class="form-control"><br>
                            @if (isset($welcome->image2))
                                <img src="{{ asset('storage/' . $welcome->image2) }}"
                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title 3</label>
                            <input type="text" name="title3" class="form-control" value="{{ $welcome->title3 ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description 3</label>
                            <textarea name="description3" class="form-control">{{ $welcome->description3 ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image 3</label>
                            <input type="file" name="image3" class="form-control"><br>
                            @if (isset($welcome->image3))
                                <img src="{{ asset('storage/' . $welcome->image3) }}"
                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
