<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'researches';

    protected $fillable = [
        'title',
        'department_id',
        'author',
        'academic_year',
        'publisher',
        'description',
        'file_path',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}