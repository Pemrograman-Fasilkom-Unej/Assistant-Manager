<?php

namespace App\Http\Controllers\Ajax;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Student;
use App\Task;
use App\TaskSubmission;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function getAssistants()
    {
        $assistants = User::whereIs('assistant');
        return DataTables::of($assistants)
            ->addIndexColumn()
            ->addColumn('action', function ($q) {
                return "<a class='btn btn-sm has-ripple btn-primary' href='". route('admin.assistant.show', $q) ."'>Detail</a>";
            })
            ->make(true);
    }

    public function getClasses(Request $request)
    {
        $classes = Classes::orderByDesc('created_at');

        if ($request->has('status')) {
            $classes = $classes->whereStatus($request->status);
        }

        return DataTables::of($classes)
            ->addIndexColumn()
            ->addColumn('_year', function($q){
                return $q->year . ($q->semester == 1 ? ' / Ganjil' : ' / Genap');
            })
            ->addColumn('_student_count', function($q){
                return $q->students->count();
            })
            ->addColumn('_task_count', function($q){
                return $q->tasks->count();
            })
            ->addColumn('action', function($q){
                if($q->status === 0){
                    $status = "<button class='btn btn-success btn-sm has-ripple' onclick='enableClass($q->id)'>Aktifkan</button>";
                } else {
                    $status = "<button class='btn btn-danger btn-sm has-ripple' onclick='disableClass($q->id)'>Nonaktifkan</button>";
                }
                return "
                    <a class='btn btn-primary btn-sm has-ripple' href='". route('admin.class.show', $q) ."'>Detail</a>
                    <a class='btn btn-info btn-sm has-ripple' href='". route('admin.class.edit', $q) ."'>Edit</a>
                    $status
                ";
            })
            ->make(true);
    }

    public function getTasks(Request $request){
        $tasks = Task::orderByDesc('due_time');
        return DataTables::of($tasks)
            ->addIndexColumn()
            ->addColumn('_class', function($q){
                return $q->classes->title;
            })
            ->addColumn('_deadline', function($q){
                return $q->due_time->format('d M Y - h:i');
            })
            ->addColumn('_url', function($q){
                return "<a href='$q->url' target='_blank'>$q->url</a>";
            })
            ->addColumn('action', function($q){
                return "<a class='btn btn-primary btn-sm has-ripple' href='". route('admin.task.show', $q) ."'>Detail</a>";
            })
            ->rawColumns(['_url', 'action'])
            ->make(true);
    }

    public function getClassDetail(Classes $class){
        $class->students->map(function($q, $i){
            $q->no = $i + 1;
            return $q;
        });
        return DataTables::of($class->students)
            ->addColumn('_name', function($q){
                return $q->student->name;
            })
            ->addColumn('_jumlah_tugas', function($q)use ($class){
                return $q->student->submissions->map(function($q) use ($class){
                    if($q->task->class_id == $class->id){
                        return $q;
                    }
                })->count();
            })
            ->addColumn('action', function($q) use ($class){
                return "<a class='btn btn-primary' href='". route('admin.class.student.detail', ['class' => $class, 'student' => $q->student]) ."'>Detail</a>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getStudentInfo($id){
        return TaskSubmission::with('student')->find($id);
    }

    public function getTickets(){
        $tickets = Ticket::orderBy('created_at')->get();
        return DataTables::of($tickets)
            ->addColumn('_status', function($q){
                if($q->status == 0){
                    return '<label class="badge badge-light-primary">Pending</label>';
                } else if($q->status == 1){
                    return '<label class="badge badge-light-warning">In Progress</label>';
                } else if($q->status == 2){
                    return '<label class="badge badge-light-success">Accepted</label>';
                } else if($q->status == 3){
                    return '<label class="badge badge-light-danger">Declined</label>';
                }

                return '-';
            })
            ->addColumn('_assistant', function($q){
                return $q->user->name;
            })
            ->addColumn('_date', function($q){
                return $q->created_at->format('F d Y');
            })
            ->addColumn('action', function($q){
                return "asdasdasd";
            })
            ->rawColumns(['_status'])
            ->make(true);
    }

    public function uploadFile(Request $request){
        return $request;
    }

    public function getStudentTaskSubmissions($id)
    {
        $task = Task::with('submissions.student')->find($id);
        if (Auth::user()->can('view', $task)) {
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
                                <a href="'. route('admin.task.submission.download', $submission) .'" target="_blank"
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
                    return $submission->created_at->format('F d Y');
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
    }
}
