<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
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
            'juara' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subjudul' => 'required|string|max:255',
            'background_color' => 'required|string|max:7',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ];
    }
}
