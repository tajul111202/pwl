<?php

namespace App\Imports;

use App\Models\Bookshelfs;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class BookShelfsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bookshelfs([
            'id' => Str::uuid(),
            'name' => $row[1],
            'code' => $row[2],
        ]);
    }
}
