<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Unit;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unit = Unit::all();

        $fasilitas = Fasilitas::with('unit')
            ->when($request->unit, function ($query) use ($request) {
                $query->where('unit_id', $request->unit);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('fasilitas.index', compact('fasilitas', 'unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = Unit::all();
        return view('fasilitas.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
        ]);

        Fasilitas::create([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
        ]);

        return redirect()->route("fasilitas.index")->with('success', 'Fasilitas berhasil ditambahkan.');
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
        $fasilitas = Fasilitas::findOrFail($id);
        $unit = Unit::all();
        return view('fasilitas.edit', compact('fasilitas', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
        ]);

        $fasilitas->update([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
        ]);

        return redirect()->route("fasilitas.index")->with('success', 'Fasilitas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route("fasilitas.index")->with('success', 'Fasilitas berhasil dihapus.');
    }
}
