<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index()
    {
        return view('dashboard.student.classroom.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|exists:classrooms,token'
        ]);

        $classroom = Classroom::where('token', $request->get('token'))->first();

        $classroom->members()->sync(Auth::id(), false);

        return redirect()->back()->with('success', 'Class has been successfully added');
    }

    public function show(Classroom $classroom)
    {
        $this->authorize('view', $classroom);
        return view('dashboard.student.classroom.show', compact('classroom'));
    }
}
