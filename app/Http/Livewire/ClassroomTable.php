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
use Livewire\WithPagination;

class ClassroomTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function acceptClassroom($id)
    {
        $token = Str::of(Uuid::uuid())->explode('-')
            ->filter(function ($str) {
                return strlen($str) === 4;
            })->join('-');

        Classroom::find($id)
            ->update([
                'accepted_at' => now(),
                'token' => $token,
                'status' => 1
            ]);

        $this->resetPage();
    }

    public function deleteClassroom($id)
    {
        Classroom::find($id)
            ->delete();

        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $classrooms = ClassroomRepository::getAssistantClassroom($this->search)->orderByDesc('created_at')->paginate(10);
        return view('livewire.classroom-table', compact('classrooms'));
    }
}
