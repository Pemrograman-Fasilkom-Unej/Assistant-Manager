<?php


namespace App\Actions\Academic;


use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeleteAssignment
{
    public function __invoke(Assignment $assignment, Request $request)
    {

    }

    public function delete(Assignment $assignment)
    {
        $assignment->delete();
        // TODO : NOTIFICATION MEMBER
    }
}
