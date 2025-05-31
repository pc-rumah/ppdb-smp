<?php

namespace App\Http\Controllers;

use App\Models\SosmedMadrasah;
use Illuminate\Http\Request;

class SosmedMadrasahController extends Controller
{
    public function create()
    {
        $data = SosmedMadrasah::first();
        return view('manage3landing.madrasah.sosmed', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

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
