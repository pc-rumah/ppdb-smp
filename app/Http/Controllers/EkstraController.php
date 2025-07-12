<?php

namespace App\Http\Controllers;

use App\Http\Requests\EkstraRequest;
use App\Models\Ekstra;

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
        $ekstra->update($validated);

        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $data = Ekstra::findOrFail($id);

        $data->delete();
        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler Berhasil di Hapus');
    }
}
