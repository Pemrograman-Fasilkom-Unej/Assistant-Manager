<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Actions\Academic\DeleteAssignment;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Livewire\Component;

class AssignmentTable extends LivewireTable
{
    public $assignments = [];
    public $all_assignments;

    public function mount()
    {
        $this->all_assignments = AssignmentRepository::getAssistantAssignments();
        $this->getData();
    }

    public function getData()
    {
        $this->assignments = $this->all_assignments->forPage($this->currentPage, $this->limit);
        $this->totalPage = ceil($this->all_assignments->count() / $this->limit);
    }

    private function refreshAssignmentData()
    {
        $this->all_assignments = AssignmentRepository::getAssistantAssignments();
    }

    public function deleteAssignment($id)
    {
        (new DeleteAssignment())->delete(Assignment::find($id));
        $this->refreshAssignmentData();
        $this->getData();
    }

    public function render()
    {
        return view('livewire.assignment-table');
    }
}
