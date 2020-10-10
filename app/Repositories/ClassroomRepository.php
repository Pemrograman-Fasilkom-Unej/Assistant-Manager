<?php


namespace App\Repositories;


use App\Models\Classroom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassroomRepository
{
    public static function getAssistantClassroom($search = null, User $user = null)
    {
        if (!$user) $user = Auth::user();

        $query = Classroom::orderByDesc('status')
            ->orderByDesc('created_at');
        if ($user->hasRole('admin')) {
            // Nothing to do
        } else {
            $query->whereHas('assistants', function ($q) use ($user) {
                $q->where('assistant_id', $user->id);
            })->whereNotNull('accepted_at');
        }

        if ($search) {
            $query->where('title', 'like', "%$search%");
        }

        return $query;
    }

    public static function getStudentClassroom($search = null, User $user = null)
    {
        if (!$user) $user = Auth::user();

        $query = Classroom::orderByDesc('status')
            ->orderByDesc('created_at')
            ->whereHas('members', function ($q) use ($user) {
                $q->where('member_id', $user->id);
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%");
            });
        }

        return $query;
    }
}
