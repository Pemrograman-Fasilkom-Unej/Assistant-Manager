<?php
/**
 * Created by PhpStorm.
 * User: miqdadyyy
 * Date: 1/20/20
 * Time: 2:21 PM
 */

namespace App;


use GuzzleHttp\Client;
use Illuminate\Support\Str;

class AssistantShortlink
{
    public static function config(){
        $client = new Client([
            'base_uri' => env("SHORTLINK_URL"),
            'headers' => [
                'token' => env("SHORTLINK_TOKEN", "TOKEN_NOT_SET"),
                'Content-Type' => "application/json"
            ]
        ]);
        return $client;
    }

    public static function getLinks(){
        $client = self::config();
        $response = $client->get("__links");
        if($response->getStatusCode() == 200){
            return collect(json_decode($response->getBody(), true)["result"]);
        } else {
            return collect([
                'code' => $response->getStatusCode()
            ]);
        }
    }

    public static function getNotes(){
        $client = self::config();
        $response = $client->get("__notes");
        if($response->getStatusCode() == 200){
            return collect(json_decode($response->getBody(), true)["result"]);
        } else {
            return collect([
                'code' => $response->getStatusCode()
            ]);
        }
    }

    public static function storeLink($long_url, $short_url = null, $is_secret = 0, $secret_key = null){
        if($short_url == null){
            $short_url = Str::random(8);
        }

        $client = self::config();
        $response = $client->post("__links", [
            'form_params' => [
                'long_url' => $long_url,
                'short_url' => $short_url,
                'is_secret' => $is_secret,
                'secret_key' => $secret_key
            ]
        ]);
    }
}