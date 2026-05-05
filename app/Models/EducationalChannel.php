<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalChannel extends Model
{
    protected $fillable = [
        'title',
        'department_id',
        'channel_url',
        'platform',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}