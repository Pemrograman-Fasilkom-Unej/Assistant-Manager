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
        $assistants = User::whereIs('assistant')->get()->map(function ($q, $i) {
            $q->no = $i + 1;
            return $q;
        });
        return DataTables::of($assistants)
            ->addColumn('action', function ($q) {
                return "<a class='btn btn-sm has-ripple btn-primary' href='". route('admin.assistant.show', $q) ."'>Detail</a>";
            })
            ->make(true);
    }

    public function getClasses(Request $request)
    {
        $classes = Classes::get()->map(function ($q, $i) {
            $q->no = $i + 1;
            return $q;
        });

        if ($request->has('status')) {
            $classes = $classes->whereStatus($request->status);
        }

        return DataTables::of($classes)
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
        $my_classes = Auth::user()->classes->pluck('class_id')->toArray();
        $tasks = Task::get()->map(function($q, $i){
            $q->no = $i + 1;
            return $q;
        });
        return DataTables::of($tasks)
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
}
