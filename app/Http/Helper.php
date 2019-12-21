<?php
/**
 * Created by PhpStorm.
 * User: miqdadyyy
 * Date: 12/18/19
 * Time: 2:01 AM
 */
if (!function_exists('check_unique_slug')) {
    function check_unique_slug($str)
    {
        $str = 'http://pemro.me/' . $str;
        $check = \App\Task::where('url', 'like', $str . '%')->get();
        if($check->count() > 0){
            $check_num = last(explode('-', $check->last()->url));
            if (strlen($check_num . '') == 4) {
                return $str . '-1';
            } else {
                $num = $check_num + 1;
                return $str . '-' . $num;
            }
        } else {
            return $str;
        }
    }
}
