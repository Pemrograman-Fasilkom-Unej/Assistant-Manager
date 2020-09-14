<?php

namespace App\Http\Controllers\Ajax;

use App\Classes;
use App\ClassStudent;
use App\Http\Controllers\Controller;
use App\Task;
use App\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AssistantController extends Controller
{
    public function getClasses(Request $request)
    {
        $classes = Auth::user()->classes->map(function ($class, $index) {
            $class->classes->no = $index + 1;
            return $class->classes;
        });

        if ($request->has('status')) {
            $classes = $classes->whereStatus($request->status);
        }

        return DataTables::of($classes)
            ->addColumn('_year', function ($q) {
                return $q->year . ($q->semester == 1 ? ' / Ganjil' : ' / Genap');
            })
            ->addColumn('_student_count', function ($q) {
                return $q->students->count();
            })
            ->addColumn('_task_count', function ($q) {
                return $q->tasks->count();
            })
            ->addColumn('action', function ($q) {
                return "
                    <a class='btn btn-primary btn-sm has-ripple' href='" . route('assistant.class.show', $q) . "'>Detail</a>   
                ";
            })
            ->make(true);
    }

    public function getTasks(Request $request)
    {
        $my_classes = Auth::user()->classes->pluck('class_id')->toArray();
        $tasks = Task::whereIn('class_id', $my_classes)->get()->map(function ($q, $i) {
            $q->no = $i + 1;
            return $q;
        });
        return DataTables::of($tasks)
            ->addColumn('_class', function ($q) {
                return $q->classes->title;
            })
            ->addColumn('_deadline', function ($q) {
                return $q->due_time->format('d M Y - h:i');
            })
            ->addColumn('_url', function ($q) {
                return "<a href='$q->url' target='_blank'>$q->url</a>";
            })
            ->addColumn('action', function ($q) {
                return "<a class='btn btn-primary btn-sm has-ripple' href='" . route('assistant.task.show', $q) . "'>Detail</a>";
            })
            ->rawColumns(['_url', 'action'])
            ->make(true);
    }

    public function getStudentInfo($id)
    {
        return TaskSubmission::with('student')->find($id);
    }

    public function getStudentTaskSubmissions($id)
    {
        $task = Task::with('submissions.student')->findOrFail($id);

        abort_unless(Auth::user()->can('view', $task), 403);

        return DataTables::of($task->submissions)
            ->addColumn('_status', function ($submission) {
                if (!is_null($submission->score)) {
                    return '<span class="badge badge-light-success">Done</span>';
                } else {
                    return '<span class="badge badge-light-warning">Pending</span>';
                }
            })
            ->addColumn('_status_order', function ($submission) {
                return !is_null($submission->score) ? 1 : 0;
            })
            ->addColumn('_nim', function ($submission) {
                return '<div class="d-inline-block align-middle">
                            <div class="d-inline-block">
                                <h6 class="m-b-0">'. $submission->student->nim .'</h6>
                            </div>
                        </div>';
            })
            ->addColumn('_name', function($submission){
                return
                '<div class="d-inline-block align-middle">
                    <div class="d-inline-block">
                        <h6 class="m-b-0">'. $submission->student->name .'</h6>
                    </div>
                </div>';
            })
            ->addColumn('_file', function($submission){
                if(!is_null($submission->files)){
                    return
                        '<div class="overlay-edit">
                            <a href="'. route('assistant.task.submission.download', $submission) .'" target="_blank"
                                class="btn btn-sm btn-icon btn-success">
                                    <i class="feather icon-download"></i>
                            </a>
                        </div>';
                }
            })
            ->addColumn('_comment', function($submission){
                return $submission->comment ?? 'No comment';
            })
            ->addColumn('_date', function($submission){
                return $submission->created_at->format('F, d Y h:i A');
            })
            ->addColumn('_score', function($submission){
                return $submission->score ?? ' - ';
            })
            ->addColumn('_action', function($submission){
                if(is_null($submission->score)){
                    return
                    '<div class="overlay-edit">
                        <button type="button" class="btn btn-sm btn-icon btn-success add-score-btn" data-toggle="modal"
                            data-id="'. $submission->id .'" data-target="#score-modal">
                                <i class="feather icon-check-circle"></i>
                        </button>
                    </div>';
                } else {
                    return
                        '<div class="overlay-edit">
                            <button type="button" class="btn btn-sm btn-icon btn-primary edit-score-btn" data-toggle="modal"
                                data-id="'. $submission->id .'" data-target="#score-modal">
                                    <i class="feather icon-edit"></i>
                            </button>
                        </div>';
                }
            })
            ->rawColumns(['_status', '_nim', '_name', '_file', '_action'])
            ->make(true);
    }

    public function getStudentWithoutTaskSubmissions($id)
    {
        $task = Task::with('submissions.student')->findOrFail($id);

        abort_unless(Auth::user()->can('view', $task), 403);

        $studentsInClass        = ClassStudent::with('student')->whereClassId($task->class_id)->get()->pluck('student');
        $studentsSubmittedTask  = $task->submissions->pluck('student');
        $studentsWithoutTask    = $studentsInClass->diff($studentsSubmittedTask);

        return DataTables::of($studentsWithoutTask)
            ->addIndexColumn()
            ->removeColumn('email')
            ->toJson();
    }
}
