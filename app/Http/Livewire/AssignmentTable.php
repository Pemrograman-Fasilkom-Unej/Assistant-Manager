<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Actions\Academic\DeleteAssignment;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteAssignment($id)
    {
        (new DeleteAssignment())->delete(Assignment::find($id));
        $this->emit('alert', [
            'type' => 'success',
            'message' => 'Assignment has been deleted'
        ]);
        $this->updatingSearch();
    }

    public function render()
    {
        $assignments = AssignmentRepository::getAssistantAssignments($this->search)->paginate(10);
        return view('livewire.assignment-table', compact('assignments'));
    }
}
