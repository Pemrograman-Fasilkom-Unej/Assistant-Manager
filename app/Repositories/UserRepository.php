<?php


namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public static function getAssistants($search = null)
    {
        return self::getUsers($search)->role('assistant');
    }

    public static function getStudents($search = null)
    {
        return self::getUsers($search)->role('student');
    }

    public static function getUsers($search = null)
    {
        $query = User::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        return $query;
    }
}
