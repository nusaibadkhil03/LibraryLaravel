<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LibraryBook;
use App\Models\Book;

class Department extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    // الكتب الورقية (للاستعارة)
    public function libraryBooks()
    {
        return $this->hasMany(LibraryBook::class);
    }

    // الكتب الرقمية (PDF)
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}