<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventPondok;
use Illuminate\Http\Request;

class EventPondokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EventPondok::paginate(5);
        return view('manage3landing.pondok.event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.pondok.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventPondok::create($data);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil disimpan');
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
    public function edit(EventPondok $eventpondok)
    {
        return view('manage3landing.pondok.event.edit', compact('eventpondok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, EventPondok $eventpondok)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventpondok->update($data);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventPondok $eventpondok)
    {
        $eventpondok->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
