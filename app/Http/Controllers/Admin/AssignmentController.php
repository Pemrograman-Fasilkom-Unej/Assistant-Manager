<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.assignment.index');
    }

    public function create()
    {
        return view('dashboard.admin.assignment.create');
    }

    public function show(Assignment $assignment)
    {
        return view('dashboard.admin.assignment.show', compact('assignment'));
    }

    public function preview(Assignment $assignment)
    {
        return view('dashboard.admin.classroom.preview', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        return view('dashboard.admin.assignment.edit', compact('assignment'));
    }
}
