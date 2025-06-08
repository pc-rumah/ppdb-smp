<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenis_pendaftaran' => 'required|in:online,offline',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:30',
            'rw' => 'required|string|max:30',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kabupaten' => 'required|string|max:50',
            'provinsi' => 'required|string|max:50',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_wa' => 'required|regex:/^[0-9]+$/|min:10|max:18',
            'email' => 'required|email|max:100',
            'asal_sekolah' => 'required|string|max:100',
            'riwayat_penyakit' => 'required|array',
            'riwayat_saudara' => 'required',
            'dokumen_tambahan' => 'nullable|array',
            'dokumen_tambahan.*' => 'in:kk,akte,ktp,rapot',
            'penanggung_jawab' => 'required|string|max:255',
            'bukti_pembayaran' => 'required_if:jenis_pendaftaran,online|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'piagam' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ];
    }
}
