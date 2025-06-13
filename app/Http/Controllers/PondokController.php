<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementPondok;
use App\Models\Cover;
use App\Models\EventPondok;
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
        $pengasuh = Pengasuh::inRandomOrder()->take(4)->get();
        $sosmed = SosmedPondok::first();
        $program = ProgramPondok::with('kategori')->take(4)->get();
        $kegiatan = Kegiatan::orderBy('created_at', 'desc')->take(3)->get();
        $eventpondok = EventPondok::orderBy('created_at', 'desc')->get();
        $pengumumanpondok = AnnouncementPondok::orderBy('created_at', 'desc')->get();
        return view('pondok', compact('cover', 'pengasuh', 'sosmed', 'program', 'kegiatan', 'eventpondok', 'pengumumanpondok'));
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
