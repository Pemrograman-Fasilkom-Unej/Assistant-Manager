<?php

namespace App\Http\Controllers\Admin;

use App\ClassAssistant;
use App\Classes;
use App\ClassStudent;
use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Classes::class, 'class');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Classes::get()->groupBy(function ($q) {
            return $q->created_at->format('Y');
        })->map(function ($q, $k) {
            return $k;
        });
        return view('dashboard.admin.class.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = [];
        for ($i = 0; $i < 5; $i++) {
            array_push($years, date('Y') - $i);
        }
        $assistants = User::whereRoleId(2)->get();
        return view('dashboard.admin.class.create', compact('years', 'assistants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:6|max:32',
            'year' => 'required',
            'semester' => 'required',
            'assistants' => 'required',
            'students' => 'required'
        ]);

        $request->request->set('status', 0);
        try {
            DB::beginTransaction();
            $class = Classes::create($request->all());
            foreach ($request->assistants as $assistant) {
                ClassAssistant::create([
                    'assistant_id' => $assistant,
                    'class_id' => $class->id
                ]);
            }
            foreach (array_unique(explode("\n", $request->students)) as $student) {
                ClassStudent::create([
                    'class_id' => $class->id,
                    'nim' => trim($student)
                ]);
            }

            DB::commit();
            toastr()->success("Kelas berhasil ditambahkan");
            return redirect()->route('admin.class.index');
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            toastr()->error($exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        return view('dashboard.admin.class.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classes $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        //
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
        //
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

    public function detailStudent(Classes $class, Student $student)
    {
        $student_detail = ClassStudent::whereClassId($class->id)->whereNim($student->nim)->firstOrFail();
        $submissions = $student->submissions->map(function ($q) use ($class) {
            if ($q->task->class_id == $class->id) {
                return $q;
            }
        });

        $current_tasks = $submissions->pluck('task_id')->toArray();
        $unsubmited_tasks = $class->tasks->map(function ($q) use ($current_tasks) {
            if (!in_array($q->id, $current_tasks)) {
                return $q;
            }
        })->filter();
        return view('dashboard.admin.class.detail', compact('class', 'student', 'student_detail', 'submissions', 'unsubmited_tasks'));
    }
}
