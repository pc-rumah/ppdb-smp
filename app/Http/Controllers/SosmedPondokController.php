<?php

namespace App\Http\Controllers;

use App\Models\SosmedPondok;
use Illuminate\Http\Request;

class SosmedPondokController extends Controller
{
    public function create()
    {
        $data = SosmedPondok::first();
        return view('manage3landing.pondok.sosmed', compact('data'));
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

        $data = SosmedPondok::first() ?? new SosmedPondok();

        $data->facebook_pondok = $request->facebook;
        $data->insta_pondok = $request->instagram;
        $data->youtube_pondok = $request->youtube;
        $data->twitter_pondok = $request->twitter;
        $data->tiktok_pondok = $request->tiktok;

        $data->save();

        return redirect()->back()->with('success', 'Data media sosial berhasil disimpan.');
    }
}
