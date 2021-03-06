<?php

namespace App\Http\Controllers\Assistant;

use App\Task;
use App\User;
use App\Classes;
use App\Student;
use App\ClassStudent;
use Mockery\Exception;
use App\ClassAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.assistant.class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function show($classId)
    {
        $class = Classes::with(['students.student.submissions' => function ($q) use ($classId) {
            return $q->whereIn('task_id', Task::whereClassId($classId)->get()->pluck('id'));
        }])->findOrFail($classId);

        abort_unless(Auth::user()->can('view', $class), 403);

        return view('dashboard.assistant.class.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        //
    }

    public function addStudent(Classes $class, Request $request)
    {
        $this->validate($request, [
            'students' => 'required'
        ]);

        if (Auth::user()->can('view', $class)) {
            try {
                DB::beginTransaction();
                foreach (array_unique(explode("\n", $request->students)) as $student) {
                    $class->students()->where('nim', trim($student))->firstOrCreate([
                        'nim' => trim($student)
                    ]);
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
            return redirect()->back()->with('success', "Mahasiswa berhasil ditambah");
        }
    }

    public function detailStudent(Classes $class, Student $student)
    {
        $student_detail = ClassStudent::whereClassId($class->id)->whereNim($student->nim)->firstOrFail();
        $submissions = $student->submissions()->with('task')->get()->filter(function ($q) use ($class) {
            return $q->task->class_id == $class->id;
        });

        $current_tasks = $submissions->pluck('task.id');
        $unsubmited_tasks = $class->tasks->whereNotIn('id', $current_tasks);
        return view('dashboard.assistant.class.detail', compact('class', 'student', 'student_detail', 'submissions', 'unsubmited_tasks'));
    }
}
