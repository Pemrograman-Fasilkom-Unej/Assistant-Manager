<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
