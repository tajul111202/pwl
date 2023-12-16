<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookShelfsRequest extends FormRequest
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
            'id' => 'nullable',
            'code' => 'required',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode rak buku wajib diisi.',
            'code.unique' => 'Kode rak buku sudah digunakan. Pilih kode lain.',
            'name.required' => 'Nama rak buku wajib diisi.',
        ];
    }
}
