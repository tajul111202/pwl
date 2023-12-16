<?php

namespace App\Exports;

use App\Models\Bookshelfs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookShelfsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bookshelfs::all();
    }

    public function headings(): array
    {
        return [
          'ID', 'Kode', 'Nama/RAK', 'Waktu Dibuat', 'Waktu Diubah'
        ];
    }
}
