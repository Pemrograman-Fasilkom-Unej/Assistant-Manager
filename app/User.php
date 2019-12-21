<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $token
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Role $role
 * @property ClassAssistant[] $classAssistants
 * @property Task[] $tasks
 */
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'name', 'nim', 'username', 'email', 'password', 'token', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany('App\ClassAssistant', 'assistant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function is($role){
        return $this->role->role === $role;
    }

    public function isAn($role){
        return $this->is($role);
    }

    public static function whereIs($role){
        return self::where('role_id', Role::where('role', $role)->first()->id);
    }
}
