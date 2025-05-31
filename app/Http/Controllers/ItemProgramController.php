<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPondok;
use App\Models\KategoriProgramPondok;
use Illuminate\Support\Facades\Storage;

class ItemProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriProgramPondok::paginate(5);
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.index', compact('kategori', 'program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.create', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:program_pondok,id',
            'nama' => 'required|string|max:255',
        ]);

        KategoriProgramPondok::create([
            'program_id' => $request->kategori_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('itemprogrampondok.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = KategoriProgramPondok::first();
        $program = ProgramPondok::all();
        return view('manage3landing.pondok.kategoriProgram.edit', compact('data', 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:program_pondok,id',
            'nama' => 'required|string|max:255',
        ]);

        $item = KategoriProgramPondok::findOrFail($id);

        $item->update([
            'kategori_id' => $request->kategori_id,
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
