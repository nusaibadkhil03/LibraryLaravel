<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LibraryBook;

class Department extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    // علاقة: القسم فيه عدة كتب فعلية
    public function libraryBooks()
    {
        return $this->hasMany(LibraryBook::class);
    }
}