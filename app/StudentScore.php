<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $score_id
 * @property string $nim
 * @property int $score
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Student $student
 *
 */
class StudentScore extends Model
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
    protected $fillable = ['score_id', 'nim', 'score', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'nim', 'nim');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function score()
    {
        return $this->belongsTo('App\Score');
    }
}
