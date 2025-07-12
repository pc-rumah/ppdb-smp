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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kegiatan', 'public');
        } else {
            $imagePath = null;
        }

        Kegiatan::create([
            'image' => $imagePath,
            'title' => $validated['title'],
            'time' => $validated['time'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('kegiatanpondok.index')->with('success', 'Data Kegiatan berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $data = Kegiatan::find($id);
        return view('manage3landing.pondok.kegiatan.edit', compact('data'));
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatanpondok)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($kegiatanpondok->image && Storage::disk('public')->exists($kegiatanpondok->image)) {
                Storage::disk('public')->delete($kegiatanpondok->image);
            }
            $imagePath = $request->file('image')->store('kegiatanpondok', 'public');
        } else {
            $imagePath = $kegiatanpondok->image;
        }

        $kegiatanpondok->update([
            'image' => $imagePath,
            'title' => $validated['title'],
            'time' => $validated['time'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('kegiatanpondok.index')->with('success', 'Data Kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatanpondok)
    {
        if ($kegiatanpondok->image && Storage::disk('public')->exists($kegiatanpondok->image)) {
            Storage::disk('public')->delete($kegiatanpondok->image);
        }
        // dd($kegiatanpondok);
        $kegiatanpondok->delete();
        return redirect()->back()->with('success', 'Data Kegiatan berhasil dihapus.');
    }
}
