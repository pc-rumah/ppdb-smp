<?php

namespace App\Http\Controllers;

use App\Models\Saudara;
use Illuminate\Http\Request;

class RsaudaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saudara = Saudara::all();
        return view('saudara.index', compact('saudara'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saudara.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:saudaras,nama',
        ]);

        Saudara::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('saudara.index')->with('success', 'Data Berhasil diTambah');
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
        $saudara = Saudara::find($id);
        return view('saudara.edit', compact('saudara'));
        // echo "biji";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saudara $saudara)
    {
        // dd($request);
        $request->validate([
            'nama' => 'required|max:255|string|unique:saudaras,nama,' . $saudara->id,
        ]);

        if (!$saudara) {
            return redirect()->route('saudara.index')->with('error', 'Data Tidak diTemukan');
        }

        Saudara::where('id', $saudara->id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('saudara.index')->with('success', 'Data Berhasil diUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saudara = Saudara::find($id);

        if (!$saudara) {
            return redirect()->route('saudara.index')->with('error', 'Data Tidak diTemukan');
        }

        $saudara->delete();
        return redirect()->route('saudara.index')->with('success', 'Data Berhasil diHapus');
    }
}
