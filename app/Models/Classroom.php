<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'season',
        'year',
        'class_day',
        'class_time',
        'status',
        'token',
        'image',
        'accepted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'accepted_at'
    ];

    public function assistants()
    {
        return $this->belongsToMany(User::class, 'classroom_assistants', 'classroom_id', 'assistant_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'classroom_members', 'classroom_id', 'member_id');
    }

    public function isPending()
    {
        return is_null($this->accepted_at);
    }

    public function isActive()
    {
        return $this->status === 1;
    }
}
