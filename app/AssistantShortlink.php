<?php
/**
 * Created by PhpStorm.
 * User: miqdadyyy
 * Date: 1/20/20
 * Time: 2:21 PM
 */

namespace App;


use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\build_query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class AssistantShortlink
{
    public static function config(){
        $client = new Client([
            'base_uri' => env("SHORTLINK_URL"),
            'headers' => [
                'KEY' => env("SHORTLINK_KEY", "TOKEN_NOT_SET"),
                'Content-Type' => "application/json"
            ]
        ]);
        return $client;
    }

    public static function storeLink($long_url, $short_url = ""){
        $client = self::config();
        $response = $client->post("link", [
            'form_params' => [
                'long_url' => $long_url,
                'short_url' => $short_url,
            ]
        ]);
        $data = json_decode($response->getBody()->getContents());
        if($data->success == 1){
            $short_url = env('SHORTLINK_URL') . $data->data->short_url;
            Link::create([
                'user_id' => Auth::id(),
                'link_id' => $data->data->_id,
                'short_url' => $short_url,
                'long_url' => $data->data->long_url
            ]);
            return $short_url;
        } else {
            throw new \Exception($data->message);
        }
    }

    public static function deleteLink($id){
        $client = self::config();
        $response = $client->delete("link/$id");
        $data = json_decode($response->getBody()->getContents());
        if($data->success == 1){
            return $data;
        } else {
            throw new \Exception($data->message);
        }
    }
}
