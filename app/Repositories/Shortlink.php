<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Http;

class Shortlink
{
    public static function getLinks($params = [])
    {
        $response = Http::withHeaders([
            'key' => env("SHORTLINK_KEY", "TOKEN_NOT_SET"),
        ])
            ->get(env('SHORTLINK_BASE_URL') . 'api/v1/link', $params)
            ->json();
        if ($response['statusCode'] === 200) {
            return $response['data'];
        } else {
            return [];
        }
    }

    public static function storeLink($long_url, $is_custom = false, $short_url = '')
    {
        $response = Http::withHeaders([
            'key' => env("SHORTLINK_KEY", "TOKEN_NOT_SET")
        ])
            ->post(env('SHORTLINK_BASE_URL') . 'api/v1/link', [
                'long_url' => $long_url,
                'is_custom' => $is_custom,
                'short_url' => $short_url,
            ])
            ->json();

        if ($response['statusCode'] === 200) {
            return env('SHORTLINK_URL_DISPLAY') . $response['data']['short_url'];
        } else {
            throw new \Exception('Shortlink Error : ' . $response['message']);
        }
    }

    public static function deleteLink($id)
    {
        $response = Http::withHeaders([
            'key' => env("SHORTLINK_KEY", "TOKEN_NOT_SET")
        ])
            ->delete(env('SHORTLINK_BASE_URL') . "api/v1/link/$id")
            ->json();
        if ($response['statusCode'] === 200) {
            return $response;
        } else {
            throw new \Exception($response['message']);
        }
    }
}
