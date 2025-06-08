<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestasiMadrasah;
use Illuminate\Support\Facades\Storage;

class PrestasiMadrasahController extends Controller
{
    public function index()
    {
        $data = PrestasiMadrasah::paginate(5);
        return view('manage3landing.madrasah.prestasi.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gelar' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('prestasi_madrasah', 'public');
        }

        PrestasiMadrasah::create([
            'gelar' => $request->gelar,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tingkat' => $request->tingkat,
            'gambar' => $gambar,
        ]);

        return redirect()->route('prestasimadrasah.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $data = PrestasiMadrasah::find($id);
        return view('manage3landing.madrasah.prestasi.edit', compact('data'));
    }

    public function update(Request $request, PrestasiMadrasah $prestasimadrasah)
    {
        $request->validate([
            'gelar' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $gambar = $prestasimadrasah->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambar && Storage::disk('public')->exists($gambar)) {
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request->file('gambar')->store('prestasi', 'public');
        }

        $prestasimadrasah->update([
            'gelar' => $request->gelar,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tingkat' => $request->tingkat,
            'gambar' => $gambar,
        ]);

        return redirect()->route('prestasimadrasah.index')->with('success', 'Data Prestasi berhasil diperbarui.');
    }

    public function destroy(PrestasiMadrasah $prestasimadrasah)
    {
        if ($prestasimadrasah->gambar && Storage::disk('public')->exists($prestasimadrasah->gambar)) {
            Storage::disk('public')->delete($prestasimadrasah->gambar);
        }

        $prestasimadrasah->delete();

        return redirect()->route('prestasimadrasah.index')->with('success', 'Data Prestasi berhasil dihapus.');
    }
}
