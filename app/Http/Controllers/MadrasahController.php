<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Madrasah;
use Illuminate\Http\Request;

class MadrasahController extends Controller
{
    public function home()
    {
        $cover = Cover::first();
        return view('madrasah', compact('cover'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cover = Cover::first();
        return view('manage3landing.madrasah.cover', compact('cover'));
    }
    public function createprogram()
    {
        // $madrasah = Madrasah::first();
        return view('manage3landing.madrasah.program');
    }
    public function createprestasi()
    {
        // $madrasah = Madrasah::first();
        return view('manage3landing.madrasah.prestasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_madrasah' => 'nullable|string|max:255',
            'deskripsi_madrasah' => 'nullable|string',
            'cover_madrasah' => 'nullable|image|max:2048',
        ]);

        // Ambil data pertama, jika belum ada maka new instance
        $cover = Cover::first() ?? new Cover();

        // Simpan cover madrasah jika ada file
        if ($request->hasFile('cover_madrasah')) {
            $cover->cover_madrasah = $request->file('cover_madrasah')->store('landing_covers', 'public');
        }

        // Simpan data lainnya
        $cover->judul_madrasah = $request->judul_madrasah;
        $cover->deskripsi_madrasah = $request->deskripsi_madrasah;

        $cover->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan atau diperbarui.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
