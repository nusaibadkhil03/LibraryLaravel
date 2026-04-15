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
        'isbn',
        'publisher',
        'publication_year',
        'category_id',
        'department_id',
        'description',
        'cover_image',
        'language',
        'pages',
        'shelf_location',
        'total_copies',
        'available_copies',
        'status',
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