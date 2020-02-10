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

if (!function_exists('json_response')) {
    function json_response($success = 1, $message = "", $data = null)
    {
        return response()->json([
            'status' => $success === 1 ? "success" : "failed",
            'message' => $message,
            'data' => $data
        ], 200);
    }
}

if (!function_exists('error_response')) {
    function error_response($error_code = 0)
    {
        if ($error_code == 404) {
            $errors = "Not Found";
        } else if ($error_code == 403) {
            $errors = "Forbidden";
        } else if ($error_code == 401) {
            $errors = "Unautorized";
        } else if ($error_code == 500) {
            $errors = "Internal Server Error";
        } else {
            $errors = "Unknown";
        }
        return json_response(0, "Something error", compact('errors'));
    }
}
