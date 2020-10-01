<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = ['key', 'value'];

    protected $dates = ['created_at', 'updated_at'];

    public static function year()
    {
        if($year = Cache::get('year')){
            return $year;
        } else {
            $year = self::where('key', 'year')->first()->value;
            Cache::forever('year', $year);
            return $year;
        }
    }

    public static function semester()
    {
        if($semester = Cache::get('semester')){
            return $semester;
        } else {
            $semester = self::where('key', 'semester')->first()->value;
            Cache::forever('semester', $semester);
            return $semester;
        }
    }
}
