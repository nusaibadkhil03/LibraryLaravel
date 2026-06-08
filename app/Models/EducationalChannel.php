<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function favorites(): MorphMany
{
    return $this->morphMany(Favorite::class, 'favoritable');
}
}