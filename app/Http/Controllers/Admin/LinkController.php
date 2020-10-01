<?php

namespace App\Http\Controllers\Admin;

use App\AssistantShortlink;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $response = AssistantShortlink::getLinks();
        $links = $this->paginateLinks($response->items, $response->itemsPerPage, $response->pageNumber, $response->totalItems, route('assistant.link.index'));
        return view('dashboard.admin.link.index', compact('links', 'response'));
    }

    public function delete(Request $request)
    {
        $response = AssistantShortlink::deleteLink($request->id);
        return redirect()->back()->with("success", "Link berhasil dihapus");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'long_url' => 'required',
            'short_url' => 'max:64'
        ]);

        AssistantShortlink::storeLink($request->long_url, $request->short_url ? true : false, $request->short_url);
        return redirect()->back()->with('success', "Link berhasil dipendekan");
    }

    public function paginateLinks(
        $items,
        $perPage = 15,
        $page = null,
        $totalItems = 0,
        $baseUrl = null,
        $options = []
    ) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ?
            $items : Collection::make($items);

        $lap = new LengthAwarePaginator(
            $items,
            $totalItems,
            $perPage,
            $page,
            $options
        );

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }
}
