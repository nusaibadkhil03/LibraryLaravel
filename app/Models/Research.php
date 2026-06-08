<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;


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
        'publication_year',
        'file_path',
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