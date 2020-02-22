<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $nim
 * @property string $name
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ClassStudent[] $classStudents
 * @property StudentScore[] $studentScores
 * @property TaskSubmission[] $taskSubmissions
 */
class Student extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nim';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classStudents()
    {
        return $this->hasMany('App\ClassStudent', 'nim', 'nim');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentScores()
    {
        return $this->hasMany('App\StudentScore', 'nim', 'nim');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany('App\TaskSubmission', 'nim', 'nim');
    }
}
