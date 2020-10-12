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

    public static function updateAssignment(Assignment $assignment, array $data)
    {
        $assignment->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => Carbon::parse($data['deadline']),
            'data_type' => implode('|', $data['formats'])
        ]);
    }

    public static function getAssistantAssignments($search = null, User $user = null)
    {
        if (is_null($user)) $user = Auth::user();

        if ($user->hasRole('admin')) {
            $query = Assignment::query();
        } else {
            $query = Assignment::with('classroom')->whereHas('classroom', function ($classroom) use ($user) {
                $classroom->whereHas('assistants', function ($assistants) use ($user) {
                    $assistants->where('assistant_id', $user->id);
                });
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('url', 'like', "%$search%")
                    ->orWhereHas('classroom', function ($q_) use ($search) {
                        $q_->where('title', 'like', "%$search%");
                    });
            });
        }

        return $query;
    }

    public static function getStudentAssignments($search = null, User $user = null)
    {
        if (is_null($user)) $user = Auth::user();

        $query = Assignment::whereHas('classroom', function ($classroom) use ($user) {
            $classroom->whereHas('members', function ($member) use ($user) {
                $member->where('users.id', $user->id);
            });
        })->orderByDesc('deadline');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('url', 'like', "%$search%")
                    ->orWhereHas('classroom', function ($q_) use ($search) {
                        $q_->where('title', 'like', "%$search%");
                    });
            });
        }

        return $query;
    }

    public static function getStudentSubmissions($search = null, Assignment $assignment)
    {
        return $assignment->classroom
            ->members()
            ->with('submissions', function ($q) use ($assignment) {
                $q->where('assignment_id', $assignment->id);
            });
    }
}
