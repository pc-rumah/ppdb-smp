<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use Illuminate\Http\Request;

class SakitController extends Controller
{
    public function index()
    {
        $sakit = Sakit::paginate(5);
        return view('sakit.index', compact('sakit'));
    }

    public function create()
    {
        return view('sakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sakits,nama',
        ]);

        Sakit::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sakit.index')
            ->with('success', 'Data Berhasil diTambah');
    }

    public function edit(Sakit $sakit)
    {
        return view('sakit.edit', compact('sakit'));
    }

    public function update(Request $request, Sakit $sakit)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sakits,nama,' . $sakit->id,
        ]);

        $sakit->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sakit.index')
            ->with('success', 'Data Berhasil diUpdate');
    }

    public function destroy(Sakit $sakit)
    {
        $sakit->delete();

        return redirect()->route('sakit.index')
            ->with('success', 'Data Berhasil diHapus');
    }
}
