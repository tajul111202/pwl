<?php

namespace App\Imports;

use App\Models\Books;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Books([
            'id' => Str::uuid(),
            'title' => $row[1],
            'author' => $row[2],
            'year' =>  $row[3],
            'publisher' => $row[4],
            'city' =>  $row[5],
            'cover' => "",
            'bookshelf_id' => "8a5efdc4-bda5-4456-a2f4-975d01ad0b9f",
        ]);
    }
}
