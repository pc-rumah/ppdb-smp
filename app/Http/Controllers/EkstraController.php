<?php

namespace App\Http\Controllers;

use App\Http\Requests\EkstraRequest;
use App\Models\Ekstra;
use Illuminate\Support\Facades\Storage;

class EkstraController extends Controller
{
    public function index()
    {
        $data = Ekstra::paginate(5);
        return view('sekolah.ekstra.index', compact('data'));
    }

    public function create()
    {
        return view('sekolah.ekstra.create');
    }

    public function store(EkstraRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ekstra', 'public');
        }

        $validated['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        Ekstra::create($validated);

        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler diajukan.');
    }

    public function edit(string $id)
    {
        $data = Ekstra::find($id);
        return view('sekolah.ekstra.edit', compact('data'));
    }

    public function update(EkstraRequest $request, string $id)
    {
        $validated = $request->validated();
        $ekstra = Ekstra::findOrFail($id);

        $newImage = $ekstra->new_gambar;

        if ($request->hasFile('gambar')) {
            $newImage = $request->file('gambar')->store('ekstra', 'public');
        }

        if (auth()->user()->hasRole('staff')) {
            $ekstra->update([
                'previous_data' => json_encode([
                    'title' => $ekstra->title,
                    'description' => $ekstra->description,
                ]),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($ekstra->gambar && Storage::disk('public')->exists($ekstra->gambar)) {
                    Storage::disk('public')->delete($ekstra->gambar);
                }
                $ekstra->gambar = $newImage;
                $ekstra->new_gambar = null;
            }

            $ekstra->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('ekstra.index')->with('success', 'Perubahan ekstrakurikuler diajukan.');
    }

    public function destroy(string $id)
    {
        $ekstra = Ekstra::findOrFail($id);

        if (auth()->user()->hasRole('staff')) {
            $ekstra->update(['status' => 'pending-delete']);
            return redirect()->route('ekstra.index')->with('success', 'Permintaan hapus diajukan.');
        }

        if ($ekstra->gambar && Storage::disk('public')->exists($ekstra->gambar)) {
            Storage::disk('public')->delete($ekstra->gambar);
        }

        $ekstra->delete();
        return redirect()->route('ekstra.index')->with('success', 'Ekstrakurikuler berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = Ekstra::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('sekolah.ekstra.index', compact('data'));
    }

    public function approve($id)
    {
        $ekstra = Ekstra::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($ekstra->new_gambar) {
            if ($ekstra->gambar && Storage::disk('public')->exists($ekstra->gambar)) {
                Storage::disk('public')->delete($ekstra->gambar);
            }
            $updateData['gambar'] = $ekstra->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $ekstra->update($updateData);

        return back()->with('success', 'Ekstrakurikuler disetujui.');
    }

    public function reject($id)
    {
        $ekstra = Ekstra::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($ekstra->previous_data) {
            $old = json_decode($ekstra->previous_data, true);
            $updateData['title'] = $old['title'];
            $updateData['description'] = $old['description'];
        }

        if ($ekstra->new_gambar && Storage::disk('public')->exists($ekstra->new_gambar)) {
            Storage::disk('public')->delete($ekstra->new_gambar);
        }

        $ekstra->update($updateData);

        return back()->with('success', 'Perubahan ekstrakurikuler ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $ekstra = Ekstra::findOrFail($id);

        if ($ekstra->gambar && Storage::disk('public')->exists($ekstra->gambar)) {
            Storage::disk('public')->delete($ekstra->gambar);
        }

        $ekstra->delete();

        return back()->with('success', 'Penghapusan ekstrakurikuler disetujui.');
    }

    public function rejectDelete($id)
    {
        $ekstra = Ekstra::findOrFail($id);

        $ekstra->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan ditolak, data tetap ada.');
    }
}
