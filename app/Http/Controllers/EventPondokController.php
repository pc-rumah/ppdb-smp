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

        $data['waktu_selesai'] = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        EventPondok::create($data);

        return redirect()->route('eventpondok.index')->with('success', 'Event diajukan.');
    }

    public function edit(EventPondok $eventpondok)
    {
        return view('manage3landing.pondok.event.edit', compact('eventpondok'));
    }

    public function update(EventRequest $request, EventPondok $eventpondok)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        if (auth()->user()->hasRole('pondok') || auth()->user()->hasRole('pondok')) {
            $eventpondok->update([
                'previous_data' => json_encode([
                    'judul' => $eventpondok->judul,
                    'lokasi' => $eventpondok->lokasi,
                    'tanggal' => $eventpondok->tanggal,
                    'waktu_mulai' => $eventpondok->waktu_mulai,
                    'waktu_selesai' => $eventpondok->waktu_selesai,
                    'deskripsi' => $eventpondok->deskripsi,
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
            $eventpondok->update(array_merge($data, [
                'status' => 'approved',
                'previous_data' => null,
            ]));
        }

        return redirect()->route('eventpondok.index')->with('success', 'Event diajukan.');
    }

    public function destroy(EventPondok $eventpondok)
    {
        if (auth()->user()->hasRole('pondok')) {
            $eventpondok->update(['status' => 'pending-delete']);
            return redirect()->route('eventpondok.index')->with('success', 'Penghapusan event diajukan.');
        }

        $eventpondok->delete();
        return redirect()->back()->with('success', 'Event berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = EventPondok::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.pondok.event.index', compact('data'));
    }

    public function approve($id)
    {
        $event = EventPondok::findOrFail($id);

        $event->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Event disetujui.');
    }

    public function reject($id)
    {
        $event = EventPondok::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($event->previous_data) {
            $old = json_decode($event->previous_data, true);
            $updateData['judul'] = $old['judul'];
            $updateData['lokasi'] = $old['lokasi'];
            $updateData['tanggal'] = $old['tanggal'];
            $updateData['waktu_mulai'] = $old['waktu_mulai'];
            $updateData['waktu_selesai'] = $old['waktu_selesai'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        $event->update($updateData);

        return back()->with('success', 'Perubahan event ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $event = EventPondok::findOrFail($id);
        $event->delete();

        return back()->with('success', 'Penghapusan event disetujui.');
    }

    public function rejectDelete($id)
    {
        $event = EventPondok::findOrFail($id);
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan event ditolak, data tetap ada.');
    }
}
