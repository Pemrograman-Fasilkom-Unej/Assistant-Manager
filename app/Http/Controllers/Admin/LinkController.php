<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.shortlink.index');
    }
}
