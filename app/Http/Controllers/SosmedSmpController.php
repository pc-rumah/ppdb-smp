<?php

namespace App\Http\Controllers;

use App\Http\Requests\SosmedRequest;
use App\Models\SosmedSmp;

class SosmedSmpController extends Controller
{
    public function create()
    {
        $data = SosmedSmp::first();
        return view('sekolah.sosmed.create', compact('data'));
    }

    public function store(SosmedRequest $request)
    {
        $request->validated();

        $data = SosmedSmp::first() ?? new SosmedSmp();

        $data->facebook_smp = $request->facebook;
        $data->insta_smp = $request->instagram;
        $data->youtube_smp = $request->youtube;
        $data->twitter_smp = $request->twitter;
        $data->tiktok_smp = $request->tiktok;

        $data->save();

        return redirect()->back()->with('success', 'Data media sosial berhasil disimpan.');
    }
}
