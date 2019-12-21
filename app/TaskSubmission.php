<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $task_id
 * @property string $nim
 * @property string $files
 * @property int $score
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Task $task
 * @property Student $student
 */
class TaskSubmission extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nim', 'files', 'score', 'comment'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'nim', 'nim');
    }
}
