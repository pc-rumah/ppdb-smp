<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::paginate(5);
        return view('manage3landing.pondok.kegiatan.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.kegiatan.create');
    }

    public function store(KegiatanRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'image' => $imagePath,
            'title' => $validated['title'],
            'time' => $validated['time'],
            'description' => $validated['description'],
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('kegiatanpondok.index')->with('success', 'Kegiatan diajukan.');
    }

    public function edit(string $id)
    {
        $data = Kegiatan::find($id);
        return view('manage3landing.pondok.kegiatan.edit', compact('data'));
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatanpondok)
    {
        $validated = $request->validated();
        $newImage = $kegiatanpondok->new_gambar;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('kegiatan', 'public');
        }

        if (auth()->user()->hasRole('pondok')) {
            $kegiatanpondok->update([
                'previous_data' => json_encode([
                    'title' => $kegiatanpondok->title,
                    'time' => $kegiatanpondok->time,
                    'description' => $kegiatanpondok->description,
                ]),
                'title' => $validated['title'],
                'time' => $validated['time'],
                'description' => $validated['description'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($kegiatanpondok->image && Storage::disk('public')->exists($kegiatanpondok->image)) {
                    Storage::disk('public')->delete($kegiatanpondok->image);
                }
                $kegiatanpondok->image = $newImage;
                $kegiatanpondok->new_gambar = null;
            }

            $kegiatanpondok->update([
                'title' => $validated['title'],
                'time' => $validated['time'],
                'description' => $validated['description'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('kegiatanpondok.index')->with('success', 'Kegiatan diajukan.');
    }

    public function destroy(Kegiatan $kegiatanpondok)
    {
        if (auth()->user()->hasRole('pondok')) {
            $kegiatanpondok->update(['status' => 'pending-delete']);
            return redirect()->route('kegiatanpondok.index')->with('success', 'Permintaan hapus diajukan.');
        }

        if ($kegiatanpondok->image && Storage::disk('public')->exists($kegiatanpondok->image)) {
            Storage::disk('public')->delete($kegiatanpondok->image);
        }

        $kegiatanpondok->delete();
        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus permanen.');
    }


    public function approval()
    {
        $data = Kegiatan::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.pondok.kegiatan.index', compact('data'));
    }

    public function approve($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($kegiatan->new_gambar) {
            if ($kegiatan->image && Storage::disk('public')->exists($kegiatan->image)) {
                Storage::disk('public')->delete($kegiatan->image);
            }
            $updateData['image'] = $kegiatan->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $kegiatan->update($updateData);

        return back()->with('success', 'Kegiatan disetujui.');
    }

    public function reject($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($kegiatan->previous_data) {
            $old = json_decode($kegiatan->previous_data, true);
            $updateData['title'] = $old['title'];
            $updateData['time'] = $old['time'];
            $updateData['description'] = $old['description'];
        }

        if ($kegiatan->new_gambar && Storage::disk('public')->exists($kegiatan->new_gambar)) {
            Storage::disk('public')->delete($kegiatan->new_gambar);
        }

        $kegiatan->update($updateData);

        return back()->with('success', 'Perubahan kegiatan ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->image && Storage::disk('public')->exists($kegiatan->image)) {
            Storage::disk('public')->delete($kegiatan->image);
        }

        $kegiatan->delete();

        return back()->with('success', 'Penghapusan kegiatan disetujui.');
    }

    public function rejectDelete($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan kegiatan ditolak, data tetap ada.');
    }
}
