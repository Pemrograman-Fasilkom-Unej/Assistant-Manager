<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        return view('dashboard.assistant.classroom.index');
    }

    public function create()
    {
        return view('dashboard.assistant.classroom.create');
    }

    public function show(Classroom $classroom)
    {
        return view('dashboard.assistant.classroom.show', compact('classroom'));
    }
}
