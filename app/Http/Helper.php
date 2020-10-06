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
        $str = env('SHORTLINK_URL') . '/' . $str;
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

if (! function_exists('in_arrayi')) {
    /**
     * Case-insensitive in_array wrapper.
     *
     * @param   mixed $needle   Value to seek.
     * @param   array $haystack Array to seek in.
     *
     * @return bool
     */
    function in_arrayi($needle, array $haystack): bool
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), false);
    }
}

if (! function_exists('validateFileTypes')) {
    /**
     * Does $type exist in $dataTypes?
     *
     * @param mixed $types      Type to check.
     * @param array $validTypes List of valid types.
     *
     * @return bool
     */
    function validateFileTypes($types, array $validTypes): bool
    {
        if (! is_array($types)) {
            return in_arrayi($types, $validTypes);
        }

        foreach ($types as $type) {
            if (! in_arrayi($type, $validTypes)) {
                return false;
            }
            continue;
        }

        return true;
    }
}
