<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'file',
        'comment',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function getFileUrlAttribute()
    {
        return Storage::cloud()->temporaryUrl(
            $this->file,
            Carbon::now()->addMinutes(5),
            []
        );
    }
}
