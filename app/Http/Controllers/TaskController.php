<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiHelper;
use App\Http\Traits\MinioHelper;
use App\Student;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiHelper, MinioHelper;

    public function show($token){
        $task = Task::whereToken($token)->firstOrFail();
        return view('home.form', compact('task'));
    }

    public function checkStudent($token, Request $request){
        $task = Task::whereToken($token)->first();

        if(is_null($task)){
            return json_response(0, "Tugas tidak ditemukan");
        }

        if(Carbon::now()->isAfter($task->due_time)){
            return json_response(0, "Waktu sudah melebihi deadline pada tugas ini");
        }

        if ($task->submissions->where('nim', $request->id)->count() > 0){
            return json_response(0, "Anda sudah mengumpulkan tugas");
        }

        if($task->classes->students->where('nim', $request->id)->count() !== 1){
            return json_response(0, "Anda tidak terdaftar pada tugas ini");
        }

        if($task->submissions->where('nim', $request->id)->count() > 0){
            return json_response(0, "Anda sudah melakukan submission pada tugas ini");
        }

        $student = $task->classes->students->where('nim', $request->id)->first();

        return json_response(1, "", compact('student'));
    }

    public function uploadSubmission($token, Request $request){
        $file = $request->file('upload_file');

        if(is_null($file)){
            return json_response(0, "Silahkan upload file");
        }

        $task = Task::whereToken($token)->first();

        if(Carbon::now()->isAfter($task->due_time)){
            return json_response(0, "Waktu sudah melebihi deadline pada tugas ini");
        }

        if(is_null($task)){
            return json_response(0, "Tugas tidak ditemukan");
        }

        if(!in_array($file->getClientOriginalExtension(), explode('|', $task->data_types))){
            return json_response(0, "Format File Salah");
        }

        if ($task->submissions->where('nim', $request->id)->count() > 0){
            return json_response(0, "Anda sudah mengumpulkan tugas");
        }

        if($task->classes->students->where('nim', $request->id)->count() !== 1){
            return json_response(0, "Anda tidak terdaftar pada tugas ini");
        }

        if($task->submissions->where('nim', $request->id)->count() > 0){
            return json_response(0, "Anda sudah melakukan submission pada tugas ini");
        }

        $student = Student::find($request->id);

        $path = $this->storeFileMinio("task/$token", $request->upload_file, $student->nim . '_' . $student->name);

        $submission = $task->submissions()->create([
            'nim' => $student->nim,
            'comment' => $request->comment,
            'files' => $path
        ]);

        return json_response(1, "Data berhasil diupload", $submission);
    }
}
