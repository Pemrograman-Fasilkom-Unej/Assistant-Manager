<?php


namespace App\Actions\Academic;


use App\Models\Assignment;
use App\Notifications\DeleteAssignmentNotification;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeleteAssignment
{
    public function __invoke(Assignment $assignment, Request $request)
    {
        $this->delete($assignment);
    }

    public function delete(Assignment $assignment)
    {
        $title = $assignment->title;
        $students = $assignment->classroom->members;
        $assignment->delete();
        foreach ($students as $student) {
            $student->notify(new DeleteAssignmentNotification($title));
        }
    }
}
