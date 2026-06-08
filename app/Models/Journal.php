<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Journal extends Model
{
    protected $fillable = [
        'title',
        'issue_number',
        'publication_year',
        'description',
        'file',
    ];

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}