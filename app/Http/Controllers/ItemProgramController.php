<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemProgramRequest;
use App\Models\ProgramPondok;
use App\Models\KategoriProgramPondok;

class ItemProgramController extends Controller
{
    public function index()
    {
        $kategori = KategoriProgramPondok::paginate(5);
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.index', compact('kategori', 'program'));
    }

    public function create()
    {
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.create', compact('program'));
    }

    public function store(ItemProgramRequest $request)
    {
        $request->validated();

        KategoriProgramPondok::create([
            'program_id' => $request->kategori_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('itemprogrampondok.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $data = KategoriProgramPondok::first();
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.edit', compact('data', 'program'));
    }

    public function update(ItemProgramRequest $request, string $id)
    {
        $request->validated();

        $item = KategoriProgramPondok::findOrFail($id);

        $item->update([
            'program_id' => $request->kategori_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('itemprogrampondok.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(KategoriProgramPondok $itemprogrampondok)
    {
        $itemprogrampondok->delete();
        return redirect()->route('itemprogrampondok.index')->with('success', 'Data berhasil dihapus.');
    }
}
