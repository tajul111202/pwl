<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|numeric|max_digits:4',
            'publisher' => 'required',
            'city' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif',
            'bookshelf_id' => 'required|exists:bookshelfs,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi.',
            'author.required' => 'Penulis harus diisi.',
            'year.required' => 'Tahun harus diisi.',
            'year.numeric' => 'Tahun harus berupa angka.',
            'year.max_digits' => 'Tahun harus memiliki maksimal 4 digit.',
            'publisher.required' => 'Penerbit harus diisi.',
            'city.required' => 'Kota harus diisi.',
            'cover.required' => 'Cover harus diunggah.',
            'cover.image' => 'Cover harus berbentuk gambar.',
            'bookshelf_id.required' => 'Rak buku harus dipilih.',
            'bookshelf_id.exists' => 'Rak buku yang dipilih tidak valid.',
        ];
    }

}
