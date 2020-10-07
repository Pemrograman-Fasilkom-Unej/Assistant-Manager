<?php


namespace App\Repositories;


use App\Models\Classroom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassroomRepository
{
    public static function getUserClassroom(User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        $query = Classroom::orderByDesc('status')
            ->orderByDesc('created_at');
        if ($user->hasRole('admin')) {
            $data = $query->get();
        } else {
            $data = $query->whereHas('assistants', function ($q) use ($user) {
                $q->where('assistant_id', $user->id);
            })->get();
        }
        return $data->map(function ($classroom) {
            $classroom->schedule = Carbon::now()
                ->next($classroom->class_day);
            return $classroom;
        });
    }
}
