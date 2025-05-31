@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Sosmed Pondok</h5>
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
                    <form method="POST" action="{{ route('sosmedpondok.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                value="{{ $data->facebook_pondok ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control"
                                value="{{ $data->insta_pondok ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Youtube</label>
                            <input type="text" name="youtube" class="form-control"
                                value="{{ $data->youtube_pondok ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control"
                                value="{{ $data->twitter_pondok ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiktok</label>
                            <input type="text" name="tiktok" class="form-control"
                                value="{{ $data->tiktok_pondok ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
