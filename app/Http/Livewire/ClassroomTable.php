<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ClassroomTable extends LivewireTable
{

    public $classrooms = [];
    public $search;

    public function mount()
    {
        $this->getData();
    }

    public function getData()
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

        $this->getData();
    }

    public function deleteClassroom($id)
    {
        Classroom::find($id)
            ->delete();

        $this->getData();
    }

    public function render()
    {
        return view('livewire.classroom-table');
    }
}
