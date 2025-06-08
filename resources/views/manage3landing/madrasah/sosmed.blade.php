@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bagan Sosmed Madrasah</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('sosmedmadrasah.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                value="{{ $data->facebook_madrasah ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control"
                                value="{{ $data->insta_madrasah ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Youtube</label>
                            <input type="text" name="youtube" class="form-control"
                                value="{{ $data->youtube_madrasah ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control"
                                value="{{ $data->twitter_madrasah ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiktok</label>
                            <input type="text" name="tiktok" class="form-control"
                                value="{{ $data->tiktok_madrasah ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
