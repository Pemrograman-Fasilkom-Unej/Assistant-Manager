<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'title',
        'description',
        'url',
        'token',
        'deadline',
        'data_type'
    ];

    protected $dates = ['deadline'];

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function getPrecentageSubmissionAttribute()
    {
        try {
            return round($this->submissions()->count() * 100 / $this->classroom->members()->count());
        } catch (\Exception $exception) {
            return 100;
        }
    }

    public function isComplete()
    {
        return Carbon::now()->isAfter($this->deadline);
    }

    public function submissionStatus($user_id){
        $submission = $this->submissions()->where('user_id', $user_id)->first();
        if($submission){
            if($submission->score){
                return [
                    'badge' => 'success',
                    'value' => 'Scored',
                ];
            } else {
                return [
                    'badge' => 'warning',
                    'value' => 'Submitted',
                ];
            }
        } else {
            return [
                'badge' => 'danger',
                'value' => 'Not Submitted'
            ];
        }
    }
}
