<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;



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
public function favorites(): MorphMany
{
    return $this->morphMany(Favorite::class, 'favoritable');
}
}