<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementMadrasah;
use App\Models\Cover;
use App\Models\EventMadrasah;
use App\Models\Kontak_Unit;
use App\Models\PrestasiMadrasah;
use App\Models\ProgramMadrasah;
use App\Models\SosmedMadrasah;
use App\Models\StaffMadrasah;
use Illuminate\Http\Request;

class MadrasahController extends Controller
{
    public function home()
    {
        $cover = Cover::first();
        $sosmed = SosmedMadrasah::first();
        $program = ProgramMadrasah::where('status', 'approved')->take(6)->get();
        $prestasi = PrestasiMadrasah::where('status', 'approved')->get();
        $eventmadrasah = EventMadrasah::where('status', 'approved')->get();
        $pengumumanmadrasah = AnnouncementMadrasah::where('status', 'approved')->get();
        $guru = StaffMadrasah::where('status', 'approved')->get();
        $kontak = Kontak_Unit::where('role_name', 'madrasah')->first();
        return view('madrasah', compact('cover', 'eventmadrasah', 'guru', 'kontak', 'pengumumanmadrasah', 'sosmed', 'program', 'prestasi'));
    }

    public function create()
    {
        $cover = Cover::first();
        return view('manage3landing.madrasah.cover', compact('cover'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo_madrasah' => 'nullable|image|mimes:png,jpg|max:4096',
            'judul_madrasah' => 'nullable|string|max:255',
            'deskripsi_madrasah' => 'nullable|string',
            'cover_madrasah' => 'nullable|image|mimes:png,jpg|max:4096',
        ]);

        $cover = Cover::first() ?? new Cover();

        if ($request->hasFile('cover_madrasah')) {
            $cover->cover_madrasah = $request->file('cover_madrasah')->store('landing_covers', 'public');
        }

        if ($request->hasFile('logo_madrasah')) {
            $cover->logo_madrasah = $request->file('logo_madrasah')->store('logo_unit', 'public');
        }

        $cover->judul_madrasah = $request->judul_madrasah;
        $cover->deskripsi_madrasah = $request->deskripsi_madrasah;

        $cover->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan atau diperbarui.');
    }
}
