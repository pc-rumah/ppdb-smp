<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventPondok;

class EventPondokController extends Controller
{
    public function index()
    {
        $data = EventPondok::paginate(5);
        return view('manage3landing.pondok.event.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.event.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        EventPondok::create($data);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil disimpan');
    }

    public function edit(EventPondok $eventpondok)
    {
        return view('manage3landing.pondok.event.edit', compact('eventpondok'));
    }

    public function update(EventRequest $request, EventPondok $eventpondok)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $eventpondok->update($data);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil di update');
    }

    public function destroy(EventPondok $eventpondok)
    {
        $eventpondok->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
