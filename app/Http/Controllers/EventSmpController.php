<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventSmp;
use Illuminate\Http\Request;

class EventSmpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventsmp = EventSmp::paginate(5);
        return view('sekolah.event.index', compact('eventsmp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekolah.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventSmp::create($data);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil disimpan');
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
    public function edit(EventSmp $eventsmp)
    {
        return view('sekolah.event.edit', compact('eventsmp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, EventSmp $eventsmp)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventsmp->update($data);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSmp $eventsmp)
    {
        $eventsmp->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
