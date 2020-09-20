<?php

namespace App\Http\Controllers\Admin;

use App\AssistantShortlink;
use App\Classes;
use App\Http\Controllers\Controller;
use App\Http\Traits\MinioHelper;
use App\Task;
use App\TaskSubmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    use MinioHelper;

    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $classes = Classes::where('status', 1)->get();
        // return $classes;
        return view('dashboard.admin.task.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Classes $class
     * @return \Illuminate\View\View
     */
    public function create(Classes $class)
    {
        $datatypes = Task::FILE_TYPES;
        return view('dashboard.admin.task.create', compact('class', 'datatypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Classes $class
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Classes $class)
    {
        $datatypes = Task::FILE_TYPES;
        $this->validate($request, [
            'title' => 'required|min:5|max:64',
            'description' => 'required|min:3',
            'datatypes' => 'required',
            'deadline' => 'required'
        ]);

        foreach ($request->datatypes as $datatype) {
            if (!in_array($datatype, $datatypes)) {
                return redirect()->back()->withInput($request->toArray())->with('errors', 'Something error about datatypes');
            }
        }

        $deadline = Carbon::parse($request->deadline);
        $token = md5(Str::random(32));
        Storage::disk('minio')->makeDirectory("tasks/$token");
        $link = AssistantShortlink::storeLink(route('task.show', $token));
        $task = Task::create([
            'user_id' => Auth::id(),
            'class_id' => $class->id,
            'title' => $request->title,
            'description' => $request->description,
            'token' => $token,
            'url' => $link,
            'due_time' => $deadline,
            'data_types' => implode('|', $request->datatypes)
        ]);

        return redirect()->route('admin.task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        $class = $task->classes;
        $task_submission = $task->submissions->groupBy(function ($q) {
            return $q->created_at->format('d M');
        })->map(function ($value, $key) {
            return $value->count();
        })->reverse();

        $student_count = $task->classes->students->count();
        $submit_count = $task->submissions->count();
        $not_submit_count = $student_count - $submit_count < 0 ? '0' : $student_count - $submit_count;

        return view('dashboard.admin.task.show', compact('task', 'class', 'task_submission', 'student_count', 'submit_count', 'not_submit_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $datatypes = Task::FILE_TYPES;
        return view('dashboard.admin.task.edit', compact('task', 'datatypes'));
    }

    public function update(Request $request, Task $task)
    {
        $datatypes = Task::FILE_TYPES;
        $this->validate($request, [
            'description' => 'required|min:3',
            'datatypes' => 'required',
            'deadline' => 'required'
        ]);

        foreach ($request->datatypes as $datatype) {
            if (!in_array($datatype, $datatypes)) {
                toastr()->error('Something error about datatypes');
                return redirect()->back()->withInput($request->toArray())->with('errors', 'Something error about datatypes');
            }
        }

        $task->update([
            'description' => $request->description,
            'data_types' => implode('|', $request->datatypes),
            'due_time' => Carbon::parse($request->deadline)
        ]);

        return \redirect()->route('admin.task.show', $task)->with('success', 'Tugas berhasil diubah');
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

    /**
     * Gives a score to submission.
     *
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        $submission = $task->submissions->where('nim', $request->nim)->first();

        $submission->update([
            'score' => $request->score
        ]);

        return response()->json([
            'success' => 1,
            'data' => $submission
        ]);
    }

    /**
     * Download submission's file
     * @param TaskSubmission $submission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadFile(TaskSubmission $submission){
        $download_url = $this->generateTemporaryUrl($submission->files);
        return Redirect::away($download_url);
    }
}
