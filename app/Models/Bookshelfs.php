<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelfs extends Model
{
    use HasFactory, UUIDs;

    protected $fillable = [
      'id',
      'code',
      'name'
    ];

    public function Book(){
        return $this->hasMany(Books::class);
    }

}
