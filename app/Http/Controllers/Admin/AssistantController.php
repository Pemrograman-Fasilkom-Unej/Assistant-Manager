<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.assistant.index');
    }

    public function create()
    {
        return view('dashboard.admin.assistant.create');
    }
}
