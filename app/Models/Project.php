<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    'title',
    'description',
    'tags',
    'url',
    'github_url',
    'image'
];
}
