<?php

namespace App\Http\Livewire;

use App\Actions\Academic\DeleteAssignment;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Livewire\Component;

class AssignmentTable extends Component
{
    public $assignments = [];
    public $currentPage = 1;
    public $firstPage = 1;
    public $limit = 10;
    public $total;
    public $totalPage;
    public $search;

    public $all_assignments;

    public function mount()
    {
        $this->all_assignments = AssignmentRepository::getAssistantAssignments();
        $this->getAssignment();
    }

    public function getAssignment()
    {
        $this->assignments = $this->all_assignments->forPage($this->currentPage, $this->limit);
        $this->totalPage = ceil($this->all_assignments->count() / $this->limit);
    }

    private function refreshAssignmentData()
    {
        $this->all_assignments = AssignmentRepository::getAssistantAssignments();
    }

    public function next()
    {
        $this->currentPage++;
        $this->getAssignment();
    }

    public function previous()
    {
        $this->currentPage--;
        $this->getAssignment();
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
        $this->getAssignment();
    }

    public function deleteAssignment($id)
    {
        (new DeleteAssignment())->delete(Assignment::find($id));
        $this->refreshAssignmentData();
        $this->getAssignment();
    }

    public function render()
    {
        return view('livewire.assignment-table');
    }
}
