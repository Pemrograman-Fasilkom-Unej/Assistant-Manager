<?php

namespace App\Http\Controllers\Ajax;

use App\Classes;
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
        $classes = Auth::user()->classes->map(function($class, $index){
            $class->classes->no = $index + 1;
            return $class->classes;
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
                return "
                    <a class='btn btn-primary btn-sm has-ripple' href='". route('assistant.class.show', $q) ."'>Detail</a>   
                ";
            })
            ->make(true);
    }

    public function getTasks(Request $request){
        $my_classes = Auth::user()->classes->pluck('class_id')->toArray();
        $tasks = Task::whereIn('class_id', $my_classes)->get()->map(function($q, $i){
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
                return "<a class='btn btn-primary btn-sm has-ripple' href='". route('assistant.task.show', $q) ."'>Detail</a>";
            })
            ->rawColumns(['_url', 'action'])
            ->make(true);
    }

    public function getStudentInfo($id){
        return TaskSubmission::with('student')->find($id);
    }
}
