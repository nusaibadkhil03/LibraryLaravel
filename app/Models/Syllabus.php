<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabuses';

    protected $fillable = [
        'title',
        'department_id',
        'academic_year',
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