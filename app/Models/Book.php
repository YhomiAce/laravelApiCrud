<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "isbn",
        "authors",
        "number_of_pages",
        "country",
        "publisher",
        "release_date"

    ];
    protected $casts = [
        'authors' => 'array'
    ];
}
