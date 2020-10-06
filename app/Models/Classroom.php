<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'season',
        'year',
        'class_day',
        'class_time',
        'status',
        'token',
        'image'
    ];
}
