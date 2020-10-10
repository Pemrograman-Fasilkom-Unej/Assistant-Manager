<?php


namespace App\Actions\Academic;


use App\Notifications\Student\NewAssignmentNotification;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateAssignment
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'classrooms' => 'required|array',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'formats' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->toArray())->withErrors($validator->errors());
        }
        $data = $request->only(['title', 'description', 'deadline', 'formats']);

        foreach ($request->classrooms as $classroom) {
            $data['classroom_id'] = $classroom;
            $this->store($data);
        }

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard.admin.assignment.index')->with('success', 'Assignment has been added');
        } else {
            return redirect()->route('dashboard.assistant.assignment.index')->with('success', 'Assignment has been added');
        }
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $assignment = AssignmentRepository::createAssignment($data);
            // TODO : Notification to members
            foreach ($assignment->classroom->members as $student) {
                $student->notify(new NewAssignmentNotification($assignment));
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }
}
