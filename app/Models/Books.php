<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory, UUIDs;
    protected $fillable = [
        "id",
        "title",
        "author",
        "year",
        "publisher",
        "city",
        "cover",
        "bookshelf_id",
    ];

    public function Bookshelfs(){
        return $this->belongsTo(Bookshelfs::class, 'bookshelf_id', 'id');
    }
}
