<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Ekstra;
use App\Models\Kepsek;
use App\Models\Prestasi;
use App\Models\SosmedSmp;
use App\Models\Staff;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function home()
    {
        $cover = Cover::first();
        $staff = Staff::all();
        $ekstra = Ekstra::all();
        $prestasi = Prestasi::all();
        $sosmed = SosmedSmp::first();
        $kepsek = Kepsek::first();
        return view('sekolah', compact('cover', 'staff', 'ekstra', 'prestasi', 'sosmed', 'kepsek'));
    }

    public function index()
    {
        //
    }

    public function indexprestasi()
    {
        $data = Staff::orderBy('created_at', 'desc')->paginate(5);
        return view('sekolah.prestasi.index', compact('data'));
    }

    public function create()
    {
        $cover = Cover::first();
        return view('manage3landing.sekolah.cover', compact('cover'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_smp' => 'nullable|string|max:255',
            'deskripsi_smp' => 'nullable|string',
            'cover_smp' => 'nullable|image|max:2048',
        ]);

        $cover = Cover::first() ?? new Cover();

        if ($request->hasFile('cover_smp')) {
            $cover->cover_smp = $request->file('cover_smp')->store('landing_covers', 'public');
        }

        $cover->judul_smp = $request->judul_smp;
        $cover->deskripsi_smp = $request->deskripsi_smp;

        $cover->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan atau diperbarui.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
