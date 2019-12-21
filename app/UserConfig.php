<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property boolean $dark_theme
 * @property boolean $collapse_sidebar
 * @property boolean $fixed_header
 * @property string $logo_background
 * @property string $navbar_background
 * @property string $sidebar_background
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 */
class UserConfig extends Model
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
    protected $fillable = ['user_id', 'dark_theme', 'collapse_sidebar', 'fixed_header', 'logo_background', 'navbar_background', 'sidebar_background', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
