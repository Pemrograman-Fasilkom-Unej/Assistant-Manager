<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('dashboard.student.assignment.index');
    }

    public function show(Assignment $assignment)
    {
        $this->authorize('view', $assignment);

        $submission = $assignment->submissions()->where('user_id', \Auth::id())->first();
        return view('dashboard.student.assignment.show', compact('assignment', 'submission'));
    }

    public function store(Assignment $assignment, Request $request)
    {
        $this->authorize('view', $assignment);

        $this->validate($request, [
            'uploaded_file' => 'required|file',
        ]);

        if ($assignment->isComplete()) {
            return redirect()->back()->with('error', 'Assignment is Overdue');
        }

        $submission = $assignment
            ->submissions()
            ->where('user_id', Auth::id())
            ->first();

        if ($submission) {
            Storage::cloud()->delete($submission->file);
            $submission->delete();
        }

        $user = Auth::user();
        $file = $request->file('uploaded_file');

        $file_path = 'assignment/submissions/' . $assignment->token;
        $filename = $user->username . "_" . $user->name . "." . $file->getClientOriginalExtension();
        Storage::cloud()->putFileAs($file_path, $file, $filename);

        $assignment->submissions()->create([
            'user_id' => Auth::id(),
            'file' => "$file_path/$filename",
            'comment' => $request->get('comment'),
        ]);

        return redirect()->route('dashboard.student.assignment.index')->with('success', 'File successfully uploaded');
    }
}
