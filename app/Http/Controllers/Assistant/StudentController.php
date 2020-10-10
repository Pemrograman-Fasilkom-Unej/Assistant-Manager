<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.student.index');
    }
}
