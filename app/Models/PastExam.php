<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastExam extends Model
{
    protected $fillable = [
        'title',
        'department_id',
        'subject_name',
        'doctor_name',
        'academic_year',
        'semester',
        'exam_year',
        'description',
        'file_path',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}