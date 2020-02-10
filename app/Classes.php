<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ClassAssistant[] $classAssistants
 * @property ClassStudent[] $classStudents
 * @property Score[] $scores
 * @property Task[] $tasks
 */
class Classes extends Model
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
    protected $fillable = ['title', 'semester', 'year', 'day', 'time', 'status', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistants()
    {
        return $this->hasMany('App\ClassAssistant', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\ClassStudent', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task', 'class_id');
    }
}
