<?php

namespace App\Http\Controllers;

use App\Http\Requests\SosmedRequest;
use App\Models\SosmedMadrasah;

class SosmedMadrasahController extends Controller
{
    public function create()
    {
        $data = SosmedMadrasah::first();
        return view('manage3landing.madrasah.sosmed', compact('data'));
    }

    public function store(SosmedRequest $request)
    {
        $request->validated();

        $data = SosmedMadrasah::first() ?? new SosmedMadrasah();

        $data->facebook_madrasah = $request->facebook;
        $data->insta_madrasah = $request->instagram;
        $data->youtube_madrasah = $request->youtube;
        $data->twitter_madrasah = $request->twitter;
        $data->tiktok_madrasah = $request->tiktok;

        $data->save();

        return redirect()->back()->with('success', 'Data media sosial berhasil disimpan.');
    }
}
