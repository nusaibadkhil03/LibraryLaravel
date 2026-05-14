<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Department;
use App\Models\Borrow;

class LibraryBook extends Model
{
    protected $fillable = [
    'title',
    'author',
    'publisher',
    'publication_year',
    'publication_place',
    'book_number',
    'department_id',
    'category_id',
    'shelf_location',
    'total_copies',
    'available_copies',
    'status',
    'edition_number',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'library_book_id');
    }
}