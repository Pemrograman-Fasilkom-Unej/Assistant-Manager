<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $class_id
 * @property integer $task_id
 * @property boolean $type
 * @property string $description
 * @property string $url
 * @property int $weight
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Class $class
 * @property Task $task
 * @property StudentScore[] $studentScores
 */
class Score extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['class_id', 'task_id', 'type', 'description', 'url', 'weight', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes()
    {
        return $this->belongsTo('App\Classes', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentScores()
    {
        return $this->hasMany('App\StudentScore');
    }
}
