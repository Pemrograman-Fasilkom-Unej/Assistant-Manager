<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ClassroomStudentTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $classrooms = ClassroomRepository::getStudentClassroom($this->search)->paginate(10);
        return view('livewire.classroom-student-table', compact('classrooms'));
    }
}
