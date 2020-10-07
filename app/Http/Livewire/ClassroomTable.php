<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;
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
        $this->classrooms = ClassroomRepository::getUserClassroom();
    }

    public function acceptClassroom($id)
    {
        $token = Str::of(Uuid::uuid())->explode('-')
            ->filter(function ($str) {
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

    public function deleteClassroom($id)
    {
        Classroom::find($id)
            ->delete();

        $this->getClassrooms();
    }

    public function render()
    {
        return view('livewire.classroom-table');
    }
}
