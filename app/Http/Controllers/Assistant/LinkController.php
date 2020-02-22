<?php

namespace App\Http\Controllers\Assistant;

use App\AssistantShortlink;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(){
        $links = AssistantShortlink::getLinks([])->map(function ($link){
            return (object)[
                'id' => $link['ID'],
                'long_url' => $link['LongUrl'],
                'short_url' => env('SHORTLINK_URL', '') . 'link/' . $link['ShortUrl'],
                'created_at' => Carbon::parse($link['CreatedAt'])
            ];
        });
        return view('dashboard.assistant.link.index', compact('links'));
    }

    public function delete(Request $request){
        $response = AssistantShortlink::deleteLink($request->id);
        return redirect()->back()->with($response->status == "failed" ? 'danger' : 'success', $response->message);
    }

    public function store(Request $request){
        $this->validate($request, [
            'long_url' => 'required',
            'short_url' => 'max:64'
        ]);

        $link = AssistantShortlink::storeLink($request->long_url, $request->short_url ?? null);
        if($link->status !== null){
            return redirect()->back()->with('errors', $link->message);
        }
        return redirect()->back()->with('success', "Link berhasil dipendekan");
    }
}
