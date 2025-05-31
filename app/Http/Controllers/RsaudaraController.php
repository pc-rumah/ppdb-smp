<?php

namespace App\Http\Controllers;

use App\Models\Saudara;
use Illuminate\Http\Request;

class RsaudaraController extends Controller
{
    public function index()
    {
        $saudara = Saudara::paginate(5);
        return view('saudara.index', compact('saudara'));
    }

    public function create()
    {
        return view('saudara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:saudaras,nama',
        ]);

        Saudara::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('saudara.index')
            ->with('success', 'Data Berhasil diTambah');
    }

    public function edit(Saudara $saudara)
    {
        return view('saudara.edit', compact('saudara'));
    }

    public function update(Request $request, Saudara $saudara)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:saudaras,nama,' . $saudara->id,
        ]);

        $saudara->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('saudara.index')
            ->with('success', 'Data Berhasil diUpdate');
    }

    public function destroy(Saudara $saudara)
    {
        $saudara->delete();

        return redirect()->route('saudara.index')
            ->with('success', 'Data Berhasil diHapus');
    }
}
