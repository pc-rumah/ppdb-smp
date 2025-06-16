<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventMadrasah;
use Illuminate\Http\Request;

class EventMadrasahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventmadrasah = EventMadrasah::paginate(5);
        return view('manage3landing.madrasah.event.index', compact('eventmadrasah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.madrasah.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventMadrasah::create($data);

        return redirect()->route('eventmadrasah.index')->with('success', 'Data Berhasil ditambahkan');
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
    public function edit(EventMadrasah $eventmadrasah)
    {
        return view('manage3landing.madrasah.event.edit', compact('eventmadrasah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, EventMadrasah $eventmadrasah)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventmadrasah->update($data);

        return redirect()->route('eventmadrasah.index')->with('success', 'Data Berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventMadrasah $eventmadrasah)
    {
        $eventmadrasah->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
