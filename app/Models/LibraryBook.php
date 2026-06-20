<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Department;
use App\Models\Borrow;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LibraryBook extends Model
{
    protected $fillable = [
    'title',
    'author',
    'publisher',
    'publication_year',
    'publication_place',
    'book_number',
    'edition_number',
    'shelf_location',
    'department_id',
    'department_name',
    'category_name',
    'total_copies',
    'available_copies',
    'status',
    'description',
    'price',
    'is_series',
    'series_name',
    'series_parts_count',
    'part_number',
    'loss_policy',
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

    public function favorites(): MorphMany
{
    return $this->morphMany(Favorite::class, 'favoritable');
}
}