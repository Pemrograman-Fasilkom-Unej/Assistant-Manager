<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('dashboard.assistant.assignment.index');
    }

    public function show(Assignment $assignment)
    {
        return view('dashboard.assistant.assignment.show', compact('assignment'));
    }

    public function create()
    {
        return view('dashboard.assistant.assignment.create');
    }
}
