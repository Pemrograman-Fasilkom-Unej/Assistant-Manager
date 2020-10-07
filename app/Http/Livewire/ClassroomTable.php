<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Livewire\Component;

class ClassroomTable extends Component
{
//    protected $listeners =[
//        'class-accepted' => '$refresh'
//    ];

    public $classrooms = [];
    public $search;

    public function mount()
    {
        $this->getClassrooms();
    }

    public function getClassrooms()
    {
        $this->classrooms = Classroom::orderByDesc('status')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($classroom) {
                $classroom->schedule = Carbon::now()
                    ->next($classroom->class_day);
                return $classroom;
            });
    }

    public function acceptClassroom($id)
    {
        $token = Str::of(Uuid::uuid())->explode('-')
            ->filter(function($str){
                return strlen($str) === 4;
            })->join('-');

        $class = Classroom::find($id)
            ->update([
                'accepted_at' => now(),
                'token' => $token,
                'status' => 1
            ]);

        $this->getClassrooms();
    }

    public function deleteClassroom($id){
        Classroom::find($id)
            ->delete();

        $this->getClassrooms();
    }

    public function render()
    {
        return view('livewire.classroom-table');
    }
}
