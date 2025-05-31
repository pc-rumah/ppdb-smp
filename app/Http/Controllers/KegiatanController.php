<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:10',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('kegiatan', 'public');

        Kegiatan::create([
            'image' => $imagePath,
            'title' => $validated['title'],
            'time' => $validated['time'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('kegiatanpondok.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $data = Kegiatan::find($id);
        return view('manage3landing.pondok.kegiatan.edit', compact('data'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:10',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($kegiatan->image && Storage::disk('public')->exists($kegiatan->image)) {
                Storage::disk('public')->delete($kegiatan->image);
            }
            $imagePath = $request->file('image')->store('kegiatan', 'public');
        } else {
            $imagePath = $kegiatan->image;
        }

        $kegiatan->update([
            'image' => $imagePath,
            'title' => $validated['title'],
            'time' => $validated['time'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('kegiatanpondok.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatanpondok)
    {
        if ($kegiatanpondok->image && Storage::disk('public')->exists($kegiatanpondok->image)) {
            Storage::disk('public')->delete($kegiatanpondok->image);
        }
        // dd($kegiatanpondok);
        $kegiatanpondok->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
