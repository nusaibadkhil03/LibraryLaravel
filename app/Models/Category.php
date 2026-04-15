<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LibraryBook;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // علاقة مع الكتب الفعلية
    public function libraryBooks()
    {
        return $this->hasMany(LibraryBook::class);
    }
}