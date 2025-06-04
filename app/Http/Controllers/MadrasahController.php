<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Madrasah;
use App\Models\PrestasiMadrasah;
use App\Models\ProgramMadrasah;
use App\Models\SosmedMadrasah;
use Illuminate\Http\Request;

class MadrasahController extends Controller
{
    public function home()
    {
        $cover = Cover::first();
        $sosmed = SosmedMadrasah::first();
        $program = ProgramMadrasah::all();
        $prestasi = PrestasiMadrasah::all();
        return view('madrasah', compact('cover', 'sosmed', 'program', 'prestasi'));
    }

    public function create()
    {
        $cover = Cover::first();
        return view('manage3landing.madrasah.cover', compact('cover'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_madrasah' => 'nullable|string|max:255',
            'deskripsi_madrasah' => 'nullable|string',
            'cover_madrasah' => 'nullable|image|max:2048',
        ]);

        $cover = Cover::first() ?? new Cover();

        if ($request->hasFile('cover_madrasah')) {
            $cover->cover_madrasah = $request->file('cover_madrasah')->store('landing_covers', 'public');
        }

        $cover->judul_madrasah = $request->judul_madrasah;
        $cover->deskripsi_madrasah = $request->deskripsi_madrasah;

        $cover->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan atau diperbarui.');
    }
}
