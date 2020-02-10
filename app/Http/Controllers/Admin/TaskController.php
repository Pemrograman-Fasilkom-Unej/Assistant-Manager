<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Task;
use App\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Auth::user()->classes;
        return view('dashboard.admin.task.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Classes $class)
    {
        $datatypes = ['zip', 'pdf', 'docx', 'rar', 'txt'];
        return view('dashboard.admin.task.create', compact('class', 'datatypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classes $class)
    {
        return $request;
        $datatypes = ['zip', 'pdf', 'docx', 'rar', 'txt'];
        $this->validate($request, [
            'title' => 'required|min:5|max:64',
            'description' => 'required|min:3',
            'datatypes' => 'required',
            'deadline' => 'required'
        ]);

        foreach ($request->datatypes as $datatype) {
            if (!in_array($datatype, $datatypes)) {
                toastr()->error("Something error about datatypes");
                return redirect()->back()->withInput($request->toArray());
            }
        }

        $unique_url = $request->title . ' ' . $class->title . ' ' . ($class->semester == 1 ? 'ganjil' : 'genap') . ' ' . $class->year;
        $unique_url = Str::slug($unique_url);
        $dates = explode(' - ', $request->deadline);
        $deadline = date('Y-m-d H:i:s', strtotime($dates[1]));
        $token = md5(Str::random(32));
        Storage::disk('minio')->makeDirectory($token);
        $task = Task::create([
            'user_id' => Auth::id(),
            'class_id' => $class->id,
            'title' => $request->title,
            'description' => $request->description,
            'token' => $token,
            'url' => check_unique_slug($unique_url),
            'due_time' => $deadline,
            'data_types' => implode("|", $request->datatypes)
        ]);

        return redirect()->route('admin.task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $class = $task->classes;
        $task_submission = $task->submissions->groupBy(function ($q) {
            return $q->created_at->format('d M');
        })->map(function ($value, $key) {
            return $value->count();
        });

        $student_count = $task->classes->students->count();
        $submit_count = $task->submissions->count();
        $not_submit_count = $student_count - $submit_count < 0 ? '0' : $student_count - $submit_count;

        return view('dashboard.admin.task.show', compact('task', 'class', 'task_submission', 'student_count', 'submit_count', 'not_submit_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function storeScore(Task $task, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|numeric|digits:12|exists:students,nim',
            'score' => 'required|numeric|min:0|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'errors' => $validator->errors()
            ]);
        }

        if (!in_array($request->nim, $task->classes->students->pluck('nim')->toArray())) {
            return response()->json([
                'success' => 0,
                'errors' => [
                    'nim' => ["Mahasiswa dengan NIM $request->nim tidak terdaftar pada kelas ini"]
                ]
            ]);
        }

        $submission = $task->submissions->where('nim', $request->nim)->first();

        $submission->update([
            'score' => $request->score
        ]);

        return response()->json([
            'success' => 1,
            'data' => $submission
        ]);
    }
}
