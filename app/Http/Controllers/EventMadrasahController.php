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
        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        EventMadrasah::create($data);

        return redirect()->route('eventmadrasah.index')->with('success', 'Event diajukan.');
    }


    public function edit(EventMadrasah $eventmadrasah)
    {
        return view('manage3landing.madrasah.event.edit', compact('eventmadrasah'));
    }

    public function update(EventRequest $request, EventMadrasah $eventmadrasah)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        if (auth()->user()->hasRole('madrasah')) {
            $eventmadrasah->update([
                'previous_data' => json_encode([
                    'judul' => $eventmadrasah->judul,
                    'lokasi' => $eventmadrasah->lokasi,
                    'tanggal' => $eventmadrasah->tanggal,
                    'waktu_mulai' => $eventmadrasah->waktu_mulai,
                    'waktu_selesai' => $eventmadrasah->waktu_selesai,
                    'deskripsi' => $eventmadrasah->deskripsi,
                ]),
                'judul' => $data['judul'],
                'lokasi' => $data['lokasi'],
                'tanggal' => $data['tanggal'],
                'waktu_mulai' => $data['waktu_mulai'],
                'waktu_selesai' => $data['waktu_selesai'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'pending',
            ]);
        } else {
            $eventmadrasah->update(array_merge($data, [
                'status' => 'approved',
                'previous_data' => null,
            ]));
        }

        return redirect()->route('eventmadrasah.index')->with('success', 'Event berhasil diajukan.');
    }

    public function destroy(EventMadrasah $eventmadrasah)
    {
        if (auth()->user()->hasRole('madrasah')) {
            $eventmadrasah->update([
                'status' => 'pending-delete'
            ]);

            return redirect()->route('eventmadrasah.index')->with('success', 'Penghapusan event diajukan, menunggu persetujuan.');
        }

        if (auth()->user()->hasRole('master-admin')) {
            $eventmadrasah->delete();
            return redirect()->route('eventmadrasah.index')->with('success', 'Event berhasil dihapus permanen.');
        }
    }

    public function approval()
    {
        $eventmadrasah = EventMadrasah::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.madrasah.event.index', compact('eventmadrasah'));
    }

    public function approve($id)
    {
        $event = EventMadrasah::findOrFail($id);

        $event->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Event disetujui.');
    }

    public function reject($id)
    {
        $event = EventMadrasah::findOrFail($id);

        if ($event->previous_data) {
            $old = json_decode($event->previous_data, true);

            $event->update([
                'judul' => $old['judul'],
                'lokasi' => $old['lokasi'],
                'tanggal' => $old['tanggal'],
                'waktu_mulai' => $old['waktu_mulai'],
                'waktu_selesai' => $old['waktu_selesai'],
                'deskripsi' => $old['deskripsi'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        } else {
            $event->update(['status' => 'approved']);
        }

        return back()->with('success', 'Perubahan event ditolak, data dikembalikan.');
    }

    public function approveDelete($id)
    {
        $event = EventMadrasah::findOrFail($id);
        $event->delete();

        return back()->with('success', 'Penghapusan event disetujui.');
    }

    public function rejectDelete($id)
    {
        $event = EventMadrasah::findOrFail($id);
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan event ditolak, data tetap ada.');
    }
}
