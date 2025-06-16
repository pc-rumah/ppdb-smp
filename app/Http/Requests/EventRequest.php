<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_type' => 'required|in:waktu,selesai',
            'waktu_selesai_time' => 'required_if:waktu_type,waktu|nullable|date_format:H:i',
            'waktu_selesai_text' => 'required_if:waktu_type,selesai|nullable|in:selesai',
            'deskripsi' => 'nullable|string',
        ];
    }
}
