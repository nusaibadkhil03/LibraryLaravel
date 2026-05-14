<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;


class Curriculum extends Model
{
    protected $fillable = [
        'type',
        'image',
        'department_id',
    ];
    public function department()
{
    return $this->belongsTo(Department::class);
}
}