<?php

namespace App\Http\Controllers;

use App\Http\Requests\SosmedRequest;
use App\Models\SosmedPondok;
use Illuminate\Http\Request;

class SosmedPondokController extends Controller
{
    public function create()
    {
        $data = SosmedPondok::first();
        return view('manage3landing.pondok.sosmed', compact('data'));
    }

    public function store(SosmedRequest $request)
    {
        $request->validated();

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
