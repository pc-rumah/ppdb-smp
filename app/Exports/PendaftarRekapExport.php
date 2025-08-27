<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Builder;

class PendaftarRekapExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(
        protected string $startDate,
        protected string $endDate,
    ) {}

    public function query(): Builder
    {
        return Pendaftar::query()
            ->whereBetween('created_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59'
            ])
            // pilih kolom yang penting buat rekap baris per pendaftar
            ->select([
                'no_pendaftaran',
                'nama_lengkap',
                'jenis_kelamin',
                'jenis_pendaftaran',
                'tempat_lahir',
                'tanggal_lahir',
                'desa_kelurahan',
                'kecamatan',
                'kabupaten_kota',
                'provinsi',
                'nama_ayah',
                'nama_ibu',
                'no_wa',
                'email',
                'asal_sekolah',
                'administrasi_lunas',
                'status',
                'created_at',
            ]);
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Jenis Pendaftaran',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Desa/Kelurahan',
            'Kecamatan',
            'Kabupaten/Kota',
            'Provinsi',
            'Nama Ayah',
            'Nama Ibu',
            'No WA',
            'Email',
            'Asal Sekolah',
            'Administrasi Lunas',
            'Status',
            'Tanggal Daftar',
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_pendaftaran,
            $row->nama_lengkap,
            $row->jenis_kelamin,
            $row->jenis_pendaftaran,
            $row->tempat_lahir,
            optional($row->tanggal_lahir)->format('Y-m-d'),
            $row->desa_kelurahan,
            $row->kecamatan,
            $row->kabupaten_kota,
            $row->provinsi,
            $row->nama_ayah,
            $row->nama_ibu,
            $row->no_wa,
            $row->email,
            $row->asal_sekolah,
            $row->administrasi_lunas ? 'Ya' : 'Tidak',
            $row->status,
            optional($row->created_at)->format('Y-m-d H:i'),
        ];
    }
}
