<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.classroom.index');
    }

    public function create()
    {
        return view('dashboard.admin.classroom.create');
    }
}
