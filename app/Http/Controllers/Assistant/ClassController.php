<?php

namespace App\Http\Controllers\Assistant;

use App\Task;
use App\User;
use App\Classes;
use App\Student;
use App\Config;
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
        $years = [];
        $days = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu"
        ];

        // current assistant
        $current_assistant = Auth::user();
        $assistants = User::whereRoleId(2)->where('id', "!=", $current_assistant->id)->get();
        return view('dashboard.assistant.class.create', compact('assistants', 'days', 'current_assistant'));
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
            'day' => 'required|min:0|max:6',
            'assistants' => 'required',
            'students' => 'required',
            'time' => 'required'
        ]);

        $request->request->set('status', 1);
        try {
            DB::beginTransaction();
            $class = Classes::create([
                'title' => $request->title,
                'day' => $request->day,
                'year' => Config::year(),
                'semester' => Config::semester(),
                'time' => $request->time
            ]);

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
            return redirect()->route('assistant.class.index')->with('success', "Kelas Berhasil Ditambahkan");
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
        $years = [];
        $days = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu"
        ];
        for ($i = 0; $i < 5; $i++) {
            array_push($years, date('Y') - $i);
        }
        $assistants = User::whereRoleId(2)->get();
        return view('dashboard.assistant.class.edit', compact('class', 'years', 'days', 'assistants'));
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
        $this->validate($request, [
            'title' => 'required|min:6|max:32',
            'day' => 'required|min:0|max:6',
            'assistants' => 'required',
            'time' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $class->update($request->all());
            $class->assistants()->delete();
            foreach ($request->assistants as $assistant) {
                ClassAssistant::create([
                    'assistant_id' => $assistant,
                    'class_id' => $class->id
                ]);
            }
            DB::commit();
            return redirect()->route('assistant.class.index')->with('success', "Kelas Berhasil Diubah");
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            toastr()->error($exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }
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

    public function disableClass(Request $request)
    {
        $class = Classes::findOrFail($request->id);
        $class->update([
            'status' => 0
        ]);

        return redirect()->back()->with('success', "Kelas berhasil dinonaktifkan");
    }

    public function enableClass(Request $request)
    {
        $class = Classes::findOrFail($request->id);
        $class->update([
            'status' => 1
        ]);

        return redirect()->back()->with('success', "Kelas berhasil diaktifkan");
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
