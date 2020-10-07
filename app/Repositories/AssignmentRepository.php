<?php


namespace App\Repositories;


use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;

class AssignmentRepository
{
    public static function createAssignment(array $data)
    {
        $token = Uuid::uuid();
        $url = Shortlink::storeLink(route('dashboard.student.assignment.submit', $token));

        return Assignment::create([
            'user_id' => Auth::id(),
            'classroom_id' => $data['classroom_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $url,
            'token' => $token,
            'deadline' => Carbon::parse($data['deadline']),
            'data_type' => implode('|', $data['formats'])
        ]);
    }

    public static function getAssistantAssignments(User $user = null)
    {
        if (is_null($user)) {
            $user = Auth::user();
        }

        if ($user->hasRole('admin')) {
            return Assignment::get();
        } else {
            return Assignment::with('classroom')->whereHas('classroom', function ($classroom) use ($user) {
                $classroom->whereHas('assistants', function ($assistants) use ($user) {
                    $assistants->where('assistant_id', $user->id);
                });
            })->get();
        }
    }
}
