<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\KategoriProgramPondok;
use App\Models\Kegiatan;
use App\Models\Pengasuh;
use App\Models\ProgramPondok;
use App\Models\SosmedPondok;
use Illuminate\Http\Request;

class PondokController extends Controller
{

    public function home()
    {
        $cover = Cover::first();
        $pengasuh = Pengasuh::all();
        $sosmed = SosmedPondok::first();
        $program = ProgramPondok::with('kategori')->get();
        $kegiatan = Kegiatan::all();
        return view('pondok', compact('cover', 'pengasuh', 'sosmed', 'program', 'kegiatan'));
    }

    public function create()
    {
        $cover = Cover::first();
        return view('manage3landing.pondok.cover', compact('cover'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pondok' => 'nullable|string|max:255',
            'deskripsi_pondok' => 'nullable|string',
            'cover_pondok' => 'nullable|image|max:2048',
        ]);

        $cover = Cover::first() ?? new Cover();

        if ($request->hasFile('cover_pondok')) {
            $cover->cover_pondok = $request->file('cover_pondok')->store('landing_covers', 'public');
        }

        $cover->judul_pondok = $request->judul_pondok;
        $cover->deskripsi_pondok = $request->deskripsi_pondok;

        $cover->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan atau diperbarui.');
    }
}
