<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'title',
        'issue_number',
        'publication_year',
        'publication_date',
        'publisher',
        'description',
        'file_path',
    ];
}