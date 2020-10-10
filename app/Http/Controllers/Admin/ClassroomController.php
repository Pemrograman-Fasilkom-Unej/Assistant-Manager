<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
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

    public function show(Classroom $classroom)
    {
        return view('dashboard.admin.classroom.show', compact('classroom'));
    }
}
