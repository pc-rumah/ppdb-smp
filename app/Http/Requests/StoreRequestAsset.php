<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestAsset extends FormRequest
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
            'nama_kontak_1' => 'required|string',
            'nomor_kontak_1' => 'required|regex:/^[0-9]+$/',
            'nama_kontak_2' => 'required|string',
            'nomor_kontak_2' => 'required|regex:/^[0-9]+$/',
            'ketua_panitia' => 'required|string',
            'tahun_ajar' => 'required|string',
            'logo_pondok_kiri' => 'nullable|image|mimes:png,jpg|max:4096',
            'logo_pondok_kanan' => 'nullable|image|mimes:png,jpg|max:4096',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg|max:4096',
        ];
    }
}
