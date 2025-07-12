<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventSmp;

class EventSmpController extends Controller
{
    public function index()
    {
        $eventsmp = EventSmp::paginate(5);
        return view('sekolah.event.index', compact('eventsmp'));
    }

    public function create()
    {
        return view('sekolah.event.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventSmp::create($data);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil disimpan');
    }

    public function edit(EventSmp $eventsmp)
    {
        return view('sekolah.event.edit', compact('eventsmp'));
    }

    public function update(EventRequest $request, EventSmp $eventsmp)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventsmp->update($data);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil di update');
    }

    public function destroy(EventSmp $eventsmp)
    {
        $eventsmp->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
