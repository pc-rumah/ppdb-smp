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
            $validated['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        Ekstra::create($validated);
        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler berhasil disimpan!');
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

        if ($request->hasFile('gambar')) {
            if ($ekstra->gambar && Storage::disk('public')->exists($ekstra->gambar)) {
                Storage::disk('public')->delete($ekstra->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        $ekstra->update($validated);
        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $data = Ekstra::findOrFail($id);
        if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
            Storage::disk('public')->delete($data->gambar);
        }

        $data->delete();
        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler Berhasil di Hapus');
    }
}
