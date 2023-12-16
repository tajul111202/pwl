<?php

namespace App\Exports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Books::all();
    }

    public function headings(): array
    {
        return [
            'Judul', 'Penulis', 'Tahun Terbit', 'Penerbit', 'Kota Terbit', 'Sampul', 'Rak'
        ];
    }
}
