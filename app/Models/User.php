<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    const CODE_SI = 10;
    const CODE_TI = 20;
    const CODE_IF = 30;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getProgramAttribute()
    {
        if (strlen($this->username) === 12) {
            $code = intval(Str::of($this->username)->after('241010')->substr(0, 2)->__toString());
            if ($code === self::CODE_SI) {
                return 'Sistem Informasi';
            } else if ($code === self::CODE_TI) {
                return 'Teknologi Informasi';
            } else if ($code === self::CODE_IF) {
                return 'Informatika';
            }
        }
        return ' - ';
    }

    public function getYearAttribute()
    {
        if (strlen($this->username) === 12) {
            return intval('20' . Str::of($this->username)->substr(0, 2)->__toString());
        }
        return ' - ';
    }
}
