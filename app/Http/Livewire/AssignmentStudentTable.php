<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentStudentTable extends Component
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
        $assignments = AssignmentRepository::getStudentAssignments($this->search)->paginate(10);
        return view('livewire.assignment-student-table', compact('assignments'));
    }
}
