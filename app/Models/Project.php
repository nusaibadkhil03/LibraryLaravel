<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'department_id',
        'students_names',
        'supervisor_name',
        'academic_year',
        'semester',
        'description',
        'file_path',
        'cover_image',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}