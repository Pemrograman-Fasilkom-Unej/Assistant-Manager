<?php

namespace App\Http\Controllers\Admin;

use App\AssistantShortlink;
use App\Http\Controllers\Controller;
use App\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(){
        $links = Link::get();
        return view('dashboard.admin.link.index', compact('links'));
    }

    public function delete(Request $request){
        $response = AssistantShortlink::deleteLink($request->id);
        Link::whereLinkId($request->id)->delete();
        return redirect()->back()->with("success", "Link berhasil dihapus");
    }

    public function store(Request $request){
        $this->validate($request, [
            'long_url' => 'required',
            'short_url' => 'max:64'
        ]);

        $link = AssistantShortlink::storeLink($request->long_url, $request->short_url ?? "");;
        return redirect()->back()->with('success', "Link berhasil dipendekan");
    }
}
