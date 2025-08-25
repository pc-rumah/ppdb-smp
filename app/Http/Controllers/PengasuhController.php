<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengasuhRequest;
use App\Models\Pengasuh;
use Illuminate\Support\Facades\Storage;

class PengasuhController extends Controller
{
    public function index()
    {
        $data = Pengasuh::paginate(5);
        return view('manage3landing.pondok.pengasuh.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.pengasuh.create');
    }

    public function store(PengasuhRequest $request)
    {
        $request->validated();

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengasuh', 'public');
        }

        Pengasuh::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('pengasuh.index')->with('success', 'Data pengasuh diajukan.');
    }


    public function edit(string $id)
    {
        $data = Pengasuh::find($id);
        return view('manage3landing.pondok.pengasuh.edit', compact('data'));
    }

    public function update(PengasuhRequest $request, Pengasuh $pengasuh)
    {
        $request->validated();

        $newFoto = $pengasuh->new_gambar;

        if ($request->hasFile('foto')) {
            $newFoto = $request->file('foto')->store('pengasuh', 'public');
        }

        if (auth()->user()->hasRole('pondok')) {
            $pengasuh->update([
                'previous_data' => json_encode([
                    'nama' => $pengasuh->nama,
                    'jabatan' => $pengasuh->jabatan,
                    'deskripsi' => $pengasuh->deskripsi,
                ]),
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'deskripsi' => $request->deskripsi,
                'new_gambar' => $newFoto,
                'status' => 'pending',
            ]);
        } else {
            if ($newFoto) {
                if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
                    Storage::disk('public')->delete($pengasuh->foto);
                }
                $pengasuh->foto = $newFoto;
                $pengasuh->new_gambar = null;
            }

            $pengasuh->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'deskripsi' => $request->deskripsi,
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('pengasuh.index')->with('success', 'Data pengasuh diajukan.');
    }

    public function destroy(string $id)
    {
        $pengasuh = Pengasuh::findOrFail($id);

        if (auth()->user()->hasRole('pondok')) {
            $pengasuh->update(['status' => 'pending-delete']);
            return redirect()->route('pengasuh.index')->with('success', 'Permintaan hapus diajukan.');
        }

        if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
            Storage::disk('public')->delete($pengasuh->foto);
        }

        $pengasuh->delete();
        return redirect()->route('pengasuh.index')->with('success', 'Data pengasuh berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = Pengasuh::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.pondok.pengasuh.index', compact('data'));
    }

    public function approve($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($pengasuh->new_gambar) {
            if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
                Storage::disk('public')->delete($pengasuh->foto);
            }
            $updateData['foto'] = $pengasuh->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $pengasuh->update($updateData);

        return back()->with('success', 'Data pengasuh disetujui.');
    }

    public function reject($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($pengasuh->previous_data) {
            $old = json_decode($pengasuh->previous_data, true);
            $updateData['nama'] = $old['nama'];
            $updateData['jabatan'] = $old['jabatan'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        if ($pengasuh->new_gambar && Storage::disk('public')->exists($pengasuh->new_gambar)) {
            Storage::disk('public')->delete($pengasuh->new_gambar);
        }

        $pengasuh->update($updateData);

        return back()->with('success', 'Perubahan pengasuh ditolak dan dikembalikan.');
    }
    public function approveDelete($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);

        if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
            Storage::disk('public')->delete($pengasuh->foto);
        }

        $pengasuh->delete();

        return back()->with('success', 'Penghapusan pengasuh disetujui.');
    }

    public function rejectDelete($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);
        $pengasuh->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan pengasuh ditolak, data tetap ada.');
    }
}
