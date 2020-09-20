<?php
/**
 * Created by PhpStorm.
 * User: miqdadyyy
 * Date: 1/20/20
 * Time: 2:21 PM
 */

namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;

class AssistantShortlink
{
    public static function config()
    {
        $client = new Client([
            'base_uri' => env("SHORTLINK_URL"),
            'headers' => [
                'key' => env("SHORTLINK_KEY", "TOKEN_NOT_SET"),
                'Content-Type' => "application/json"
            ]
        ]);
        return $client;
    }

    public static function getLinks($params = [])
    {
        $client = self::config();
        $response = $client->get('/api/v1/link', [
            'query' => $params
        ]);
        $data = json_decode($response->getBody()->getContents(), false);
        if($data->statusCode){
            return $data->data;
        } else {
            return [];
        }
    }

    public static function storeLink($long_url, $is_custom = false, $short_url = '')
    {
        $client = self::config();
        $response = $client->post("/api/v1/link", [
            RequestOptions::JSON => [
                'long_url' => $long_url,
                'is_custom' => $is_custom,
                'short_url' => $short_url,
            ]
        ]);
        $apiData = json_decode($response->getBody()->getContents(), true);
        if ($apiData['statusCode'] === 200) {
            return env('SHORTLINK_URL') . $apiData['data']['short_url'];
        } else {
            throw new \Exception('Shortlink Error : ' . $apiData['message']);
        }
    }

    public static function deleteLink($id)
    {
        $client = self::config();
        $response = $client->delete("/api/v1/link/$id");
        $data = json_decode($response->getBody()->getContents());
        if ($data->statusCode === 200) {
            return $data;
        } else {
            throw new \Exception($data->message);
        }
    }
}
