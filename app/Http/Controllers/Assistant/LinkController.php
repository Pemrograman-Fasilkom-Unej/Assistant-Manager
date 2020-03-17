<?php

namespace App\Http\Controllers\Assistant;

use App\AssistantShortlink;
use App\Link;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::get();
        return view('dashboard.assistant.link.index', compact('links'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'long_url' => 'required',
            'short_url' => 'max:64'
        ]);

        $link = AssistantShortlink::storeLink($request->long_url, $request->short_url ?? "");
        return redirect()->back()->with('success', "Link berhasil dipendekan");
    }
}
