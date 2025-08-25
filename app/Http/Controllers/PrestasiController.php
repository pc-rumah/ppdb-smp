<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestasiRequest;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $data = Prestasi::paginate(5);
        return view('sekolah.prestasi.index', compact('data'));
    }

    public function create()
    {
        return view('sekolah.prestasi.create');
    }

    public function store(PrestasiRequest $request)
    {
        $validated = $request->validated();

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create([
            'juara' => $validated['juara'],
            'title' => $validated['title'],
            'subjudul' => $validated['subjudul'],
            'foto' => $foto,
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi diajukan.');
    }


    public function edit(string $id)
    {
        $data = Prestasi::find($id);
        return view('sekolah.prestasi.edit', compact('data'));
    }

    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $validated = $request->validated();

        $newImage = $prestasi->new_gambar;

        if ($request->hasFile('foto')) {
            $newImage = $request->file('foto')->store('prestasi', 'public');
        }

        if (auth()->user()->hasRole('staff')) {
            $prestasi->update([
                'previous_data' => json_encode([
                    'juara' => $prestasi->juara,
                    'title' => $prestasi->title,
                    'subjudul' => $prestasi->subjudul,
                ]),
                'juara' => $validated['juara'],
                'title' => $validated['title'],
                'subjudul' => $validated['subjudul'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
                    Storage::disk('public')->delete($prestasi->foto);
                }
                $prestasi->foto = $newImage;
                $prestasi->new_gambar = null;
            }

            $prestasi->update([
                'juara' => $validated['juara'],
                'title' => $validated['title'],
                'subjudul' => $validated['subjudul'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi diajukan.');
    }

    public function destroy(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if (auth()->user()->hasRole('staff')) {
            $prestasi->update(['status' => 'pending-delete']);
            return redirect()->route('prestasi.index')->with('success', 'Permintaan hapus diajukan.');
        }

        if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = Prestasi::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('sekolah.prestasi.index', compact('data'));
    }

    public function approve($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($prestasi->new_gambar) {
            if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $updateData['foto'] = $prestasi->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $prestasi->update($updateData);

        return back()->with('success', 'Prestasi disetujui.');
    }

    public function reject($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($prestasi->previous_data) {
            $old = json_decode($prestasi->previous_data, true);
            $updateData['juara'] = $old['juara'];
            $updateData['title'] = $old['title'];
            $updateData['subjudul'] = $old['subjudul'];
        }

        if ($prestasi->new_gambar && Storage::disk('public')->exists($prestasi->new_gambar)) {
            Storage::disk('public')->delete($prestasi->new_gambar);
        }

        $prestasi->update($updateData);

        return back()->with('success', 'Perubahan prestasi ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return back()->with('success', 'Penghapusan prestasi disetujui.');
    }

    public function rejectDelete($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan prestasi ditolak, data tetap ada.');
    }
}
