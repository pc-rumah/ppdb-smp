<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventMadrasah;

class EventMadrasahController extends Controller
{
    public function index()
    {
        $eventmadrasah = EventMadrasah::paginate(5);
        return view('manage3landing.madrasah.event.index', compact('eventmadrasah'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.event.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventMadrasah::create($data);

        return redirect()->route('eventmadrasah.index')->with('success', 'Data Berhasil ditambahkan');
    }

    public function edit(EventMadrasah $eventmadrasah)
    {
        return view('manage3landing.madrasah.event.edit', compact('eventmadrasah'));
    }

    public function update(EventRequest $request, EventMadrasah $eventmadrasah)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventmadrasah->update($data);

        return redirect()->route('eventmadrasah.index')->with('success', 'Data Berhasil ditambahkan');
    }

    public function destroy(EventMadrasah $eventmadrasah)
    {
        $eventmadrasah->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
