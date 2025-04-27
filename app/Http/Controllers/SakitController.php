<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use Illuminate\Http\Request;

class SakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sakit = Sakit::all();
        return view('sakit.index', compact('sakit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sakits,nama',
        ]);

        Sakit::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sakit.index')->with('success', 'Data Berhasil diTambah');
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
    public function edit(Sakit $sakit)
    {
        // $sakit = Sakit::find($id);
        return view('sakit.edit', compact('sakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sakit $sakit)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:sakits,nama|string',
        ]);

        if (!$sakit) {
            return redirect()->route('sakit.index')->with('error', 'Data Tidak diTemukan');
        }

        Sakit::where('id', $sakit->id)->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('sakit.index')->with('success', 'Data Berhasil diUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sakit $sakit)
    {
        if (!$sakit) {
            return redirect()->route('sakit.index')->with('error', 'Data Tidak diTemukan');
        }

        $sakit->delete();
        return redirect()->route('sakit.index')->with('success', 'Data Berhasil diHapus');
    }
}
