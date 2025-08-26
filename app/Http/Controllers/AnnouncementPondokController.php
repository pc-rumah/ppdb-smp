<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\AnnouncementPondok;
use Illuminate\Support\Facades\Storage;

class AnnouncementPondokController extends Controller
{
    public function index()
    {
        $data = AnnouncementPondok::paginate(5);
        return view('manage3landing.pondok.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanpondok', 'public');
        }

        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        AnnouncementPondok::create($data);

        return redirect()->route('pengumumanpondok.index')->with('success', 'Pengumuman diajukan.');
    }

    public function edit(AnnouncementPondok $pengumumanpondok)
    {
        return view('manage3landing.pondok.pengumuman.edit', compact('pengumumanpondok'));
    }

    public function update(AnnouncementRequest $request, AnnouncementPondok $pengumumanpondok)
    {
        $data = $request->validated();
        $newImage = $pengumumanpondok->new_gambar;

        if ($request->hasFile('gambar')) {
            $newImage = $request->file('gambar')->store('pengumumanpondok', 'public');
        }

        if (auth()->user()->hasRole('pondok')) {
            $pengumumanpondok->update([
                'previous_data' => json_encode([
                    'judul' => $pengumumanpondok->judul,
                    'tanggal' => $pengumumanpondok->tanggal,
                    'deskripsi' => $pengumumanpondok->deskripsi,
                ]),
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($pengumumanpondok->gambar && Storage::disk('public')->exists($pengumumanpondok->gambar)) {
                    Storage::disk('public')->delete($pengumumanpondok->gambar);
                }
                $pengumumanpondok->gambar = $newImage;
                $pengumumanpondok->new_gambar = null;
            }

            $pengumumanpondok->update([
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('pengumumanpondok.index')->with('success', 'Pengumuman diajukan.');
    }

    public function destroy(AnnouncementPondok $pengumumanpondok)
    {
        if (auth()->user()->hasRole('pondok')) {
            $pengumumanpondok->update(['status' => 'pending-delete']);
            return redirect()->back()->with('success', 'Permintaan hapus diajukan.');
        }

        if ($pengumumanpondok->gambar && Storage::disk('public')->exists($pengumumanpondok->gambar)) {
            Storage::disk('public')->delete($pengumumanpondok->gambar);
        }

        $pengumumanpondok->delete();
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = AnnouncementPondok::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.pondok.pengumuman.index', compact('data'));
    }

    public function approve($id)
    {
        $pengumuman = AnnouncementPondok::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($pengumuman->new_gambar) {
            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $updateData['gambar'] = $pengumuman->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $pengumuman->update($updateData);

        return back()->with('success', 'Pengumuman disetujui.');
    }

    public function reject($id)
    {
        $pengumuman = AnnouncementPondok::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($pengumuman->previous_data) {
            $old = json_decode($pengumuman->previous_data, true);
            $updateData['judul'] = $old['judul'];
            $updateData['tanggal'] = $old['tanggal'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        if ($pengumuman->new_gambar && Storage::disk('public')->exists($pengumuman->new_gambar)) {
            Storage::disk('public')->delete($pengumuman->new_gambar);
        }

        $pengumuman->update($updateData);

        return back()->with('success', 'Perubahan pengumuman ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $pengumuman = AnnouncementPondok::findOrFail($id);

        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return back()->with('success', 'Penghapusan pengumuman disetujui.');
    }

    public function rejectDelete($id)
    {
        $pengumuman = AnnouncementPondok::findOrFail($id);
        $pengumuman->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan pengumuman ditolak, data tetap ada.');
    }
}
