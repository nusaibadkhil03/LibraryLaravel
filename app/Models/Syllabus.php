<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;


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
        'lecture_number',
        'doctor_name',
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