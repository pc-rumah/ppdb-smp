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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
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
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('prestasimadrasah.index')->with('success', 'Prestasi diajukan.');
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
        ]);

        $newGambar = $prestasimadrasah->new_gambar;

        if ($request->hasFile('gambar')) {
            $newGambar = $request->file('gambar')->store('prestasi_madrasah', 'public');
        }

        if (auth()->user()->hasRole('madrasah')) {
            $prestasimadrasah->update([
                'previous_data' => json_encode([
                    'gelar' => $prestasimadrasah->gelar,
                    'nama_kegiatan' => $prestasimadrasah->nama_kegiatan,
                    'tingkat' => $prestasimadrasah->tingkat,
                ]),
                'gelar' => $request->gelar,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tingkat' => $request->tingkat,
                'new_gambar' => $newGambar,
                'status' => 'pending',
            ]);
        } else {
            if ($newGambar) {
                if ($prestasimadrasah->gambar && Storage::disk('public')->exists($prestasimadrasah->gambar)) {
                    Storage::disk('public')->delete($prestasimadrasah->gambar);
                }
                $prestasimadrasah->gambar = $newGambar;
                $prestasimadrasah->new_gambar = null;
            }

            $prestasimadrasah->update([
                'gelar' => $request->gelar,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tingkat' => $request->tingkat,
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('prestasimadrasah.index')->with('success', 'Prestasi diajukan.');
    }

    public function destroy(PrestasiMadrasah $prestasimadrasah)
    {
        if (auth()->user()->hasRole('madrasah')) {
            $prestasimadrasah->update([
                'status' => 'pending-delete'
            ]);

            return redirect()->route('prestasimadrasah.index')->with('success', 'Penghapusan prestasi diajukan, menunggu persetujuan.');
        }

        if (auth()->user()->hasRole('master-admin')) {
            if ($prestasimadrasah->gambar && Storage::disk('public')->exists($prestasimadrasah->gambar)) {
                Storage::disk('public')->delete($prestasimadrasah->gambar);
            }

            $prestasimadrasah->delete();

            return redirect()->route('prestasimadrasah.index')->with('success', 'Prestasi berhasil dihapus permanen.');
        }
    }

    public function approval()
    {
        $data = PrestasiMadrasah::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.madrasah.prestasi.index', compact('data'));
    }

    public function approve($id)
    {
        $prestasi = PrestasiMadrasah::findOrFail($id);

        if ($prestasi->new_gambar) {
            if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
                Storage::disk('public')->delete($prestasi->gambar);
            }
            $prestasi->update([
                'gambar' => $prestasi->new_gambar,
                'new_gambar' => null,
            ]);
        }

        $prestasi->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Prestasi disetujui.');
    }

    public function reject($id)
    {
        $prestasi = PrestasiMadrasah::findOrFail($id);

        if ($prestasi->previous_data) {
            $old = json_decode($prestasi->previous_data, true);

            $prestasi->update([
                'gelar' => $old['gelar'],
                'nama_kegiatan' => $old['nama_kegiatan'],
                'tingkat' => $old['tingkat'],
                'previous_data' => null,
            ]);
        }

        if ($prestasi->new_gambar && Storage::disk('public')->exists($prestasi->new_gambar)) {
            Storage::disk('public')->delete($prestasi->new_gambar);
        }

        $prestasi->update([
            'new_gambar' => null,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Perubahan ditolak, data dikembalikan ke versi sebelumnya.');
    }

    public function approveDelete($id)
    {
        $prestasi = PrestasiMadrasah::findOrFail($id);

        if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return back()->with('success', 'Penghapusan prestasi disetujui.');
    }

    public function rejectDelete($id)
    {
        $prestasi = PrestasiMadrasah::findOrFail($id);

        $prestasi->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan prestasi ditolak, data tetap ada.');
    }
}
