<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unit = Unit::all();
        $keunggulan = Keunggulan::with('unit')
            ->when($request->unit, function ($query) use ($request) {
                $query->where('unit_id', $request->unit);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('keunggulan.index', compact('keunggulan', 'unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = Unit::all();
        return view('keunggulan.create', compact('unit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
        ]);

        Keunggulan::create([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
        ]);

        return redirect()->route('keunggulan.index')->with('success', 'Keunggulan berhasil ditambahkan.');
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
        $keunggulan = Keunggulan::findOrFail($id);
        $unit = Unit::all();
        return view('keunggulan.edit', compact('keunggulan', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
        ]);

        $keunggulan = Keunggulan::findOrFail($id);

        $keunggulan->update([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
        ]);

        return redirect()->route('keunggulan.index')->with('success', 'Keunggulan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
