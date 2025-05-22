<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PendaftarExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Pendaftar::all();
        return Pendaftar::select([
            'no_pendaftaran',
            'jenis_pendaftaran',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'dusun',
            'rt',
            'rw',
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
            'saudaras_id',
            'penanggung_jawab',
        ])->with('riwayatSaudara')->get();
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Jenis Pendaftaran',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Dusun',
            'RT',
            'RW',
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
            'Saudara ID',
            'Penanggung Jawab',
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_pendaftaran,
            $row->jenis_pendaftaran,
            $row->nama_lengkap,
            $row->jenis_kelamin,
            $row->tempat_lahir,
            $row->tanggal_lahir,
            $row->dusun,
            $row->rt,
            $row->rw,
            $row->desa_kelurahan,
            $row->kecamatan,
            $row->kabupaten_kota,
            $row->provinsi,
            $row->nama_ayah,
            $row->nama_ibu,
            $row->no_wa,
            $row->email,
            $row->asal_sekolah,
            $row->administrasi_lunas ? 'Lunas' : 'Belum Lunas',
            optional($row->saudaras)->nama,
            $row->penanggung_jawab,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Baris heading tebal
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 25,
            'D' => 15,
            'E' => 20,
            'F' => 15,
            'G' => 20,
            'H' => 5,
            'I' => 5,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 15,
            'Q' => 25,
            'R' => 25,
            'S' => 20,
            'T' => 15,
            'U' => 25,
        ];
    }
}
