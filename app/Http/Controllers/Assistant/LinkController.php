<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return view('dashboard.assistant.shortlink.index');
    }
}
