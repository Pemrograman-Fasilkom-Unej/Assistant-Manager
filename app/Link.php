<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $link_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Link extends Model
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
    protected $fillable = ['user_id', 'link_id', 'short_url', 'long_url'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
