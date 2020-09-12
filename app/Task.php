<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $class_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $token
 * @property string $due_time
 * @property string $data_types
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property Class $class
 * @property Score[] $scores
 * @property TaskSubmission[] $taskSubmissions
 */
class Task extends Model
{
    /**
     * List of accepted format for uploading a task.
     *
     * @var array
     */
    public const FILE_TYPES = ['zip', 'pdf', 'docx', 'rar', 'txt', 'jpg', 'png', 'jpeg', 'doc'];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'class_id', 'title', 'description', 'url', 'token', 'due_time', 'data_types', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'due_time'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes()
    {
        return $this->belongsTo('App\Classes', 'class_id');
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
    public function submissions()
    {
        return $this->hasMany('App\TaskSubmission');
    }

    public function getFileTypeFormatAttribute(){
        $temp = [];
        foreach (explode("|", $this->data_types) as $type){
            array_push($temp, ".$type");
        }
        return implode(",", $temp);
    }
}
