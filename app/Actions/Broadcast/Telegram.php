<?php


namespace App\Actions\Broadcast;


use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use App\Notifications\BroadcastNotification;
use App\Notifications\Student\NewAssignmentNotification;
use App\Notifications\UpdateAssignmentNotification;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class Telegram
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'classrooms' => 'required|array',
            'messages' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->toArray())->withErrors($validator->errors());
        }

        if (in_array('-1', $request->classrooms) && Auth::user()->hasRole('admin')) {
            $this->broadcastToAllStudents($request->messages);
        } else {
            $this->broadcastToClassrooms($request->classrooms, $request->messages);
        }

        return redirect()->back()->with('success', 'Message has been broadcasted');
    }

    private function broadcastToClassrooms($classrooms, $message)
    {
        foreach ($classrooms as $classroom_id) {
            $classroom = Classroom::find($classroom_id);
            $students = $classroom->members->where('telegram_id', '<>', null);
            Notification::send($students, new BroadcastNotification($message));
        }
    }

    private function broadcastToAllStudents($message)
    {
        $students = User::role('student')->whereNotNull('telegram_id')->get();
        Notification::send($students, new BroadcastNotification($message));
    }
}
