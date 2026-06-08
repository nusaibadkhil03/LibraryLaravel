<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Book extends Model
{
    protected $fillable = [
    'title',
    'author',
    'department_id',
    'semester',
    'description',
    'file_path',
    'status',
];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function favorites(): MorphMany
{
    return $this->morphMany(Favorite::class, 'favoritable');
}
}