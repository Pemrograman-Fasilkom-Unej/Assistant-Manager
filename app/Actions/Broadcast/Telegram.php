<?php


namespace App\Actions\Broadcast;


use App\Models\Assignment;
use App\Notifications\Student\NewAssignmentNotification;
use App\Notifications\UpdateAssignmentNotification;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Telegram
{
    public function __invoke(Request $request)
    {
        return $request;
    }

    public function store($data)
    {

    }
}
