<?php

namespace App\Http\Controllers;

use App\Models\SosmedSmp;
use Illuminate\Http\Request;

class SosmedSmpController extends Controller
{
    public function create()
    {
        $data = SosmedSmp::first();
        return view('sekolah.sosmed.create', compact('data'));
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

        $data = SosmedSmp::first() ?? new SosmedSmp();

        $data->facebook_smp = $request->facebook;
        $data->insta_smp = $request->instagram;
        $data->youtube_smp = $request->youtube;
        $data->twitter_smp = $request->twitter;
        $data->tiktok_smp = $request->tiktok;

        $data->save();

        return redirect()->back()->with('success', 'Data media sosial berhasil disimpan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
