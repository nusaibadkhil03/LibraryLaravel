<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}