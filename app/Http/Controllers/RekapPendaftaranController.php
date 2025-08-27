<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarRekapExport;

class RekapPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        // ambil rentang tanggal dari query (opsional)
        $start = $request->query('start_date');
        $end   = $request->query('end_date');

        // Query dasar by created_at
        $query = Pendaftar::query();
        if ($start && $end) {
            $query->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        // Agregat cepat untuk ringkasan
        $total = (clone $query)->count();
        $perStatus = (clone $query)->selectRaw('status, COUNT(*) as jml')->groupBy('status')->pluck('jml', 'status');
        $perGender = (clone $query)->selectRaw('jenis_kelamin, COUNT(*) as jml')->groupBy('jenis_kelamin')->pluck('jml', 'jenis_kelamin');
        $perJenisDaftar = (clone $query)->selectRaw('jenis_pendaftaran, COUNT(*) as jml')->groupBy('jenis_pendaftaran')->pluck('jml', 'jenis_pendaftaran');
        $administrasi = [
            'lunas' => (clone $query)->where('administrasi_lunas', true)->count(),
            'belum' => (clone $query)->where('administrasi_lunas', false)->count(),
        ];
        // contoh top 10 kabupaten_kota
        $topKabupaten = (clone $query)
            ->selectRaw('kabupaten_kota, COUNT(*) as jml')
            ->groupBy('kabupaten_kota')
            ->orderByDesc('jml')
            ->limit(10)
            ->get();

        return view('rekap.pendaftar', compact(
            'start',
            'end',
            'total',
            'perStatus',
            'perGender',
            'perJenisDaftar',
            'administrasi',
            'topKabupaten'
        ));
    }

    public function download(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
            'format'     => ['nullable', 'in:xlsx,csv'],
        ]);

        $format = $validated['format'] ?? 'xlsx';
        $fileName = 'rekap_pendaftar_' . $validated['start_date'] . '_sd_' . $validated['end_date'] . '.' . $format;

        return Excel::download(
            new PendaftarRekapExport($validated['start_date'], $validated['end_date']),
            $fileName,
            $format === 'csv' ? \Maatwebsite\Excel\Excel::CSV : \Maatwebsite\Excel\Excel::XLSX
        );
    }
}
