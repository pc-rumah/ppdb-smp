<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengasuhRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ];
    }
}
