<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AssignmentDetailStatsCard extends Component
{
    public $assignment;
    public $totalStudent;
    public $totalSubmitted;
    public $totalUnsubmitted;
    public $formats;

    public function mount()
    {
        $this->getStatsData();
    }

    public function getStatsData()
    {
        $this->totalStudent = $this->assignment->classroom->members()->count();
        $this->totalSubmitted = $this->assignment->submissions()->count();
        $this->totalUnsubmitted = $this->totalStudent - $this->totalUnsubmitted;
        $this->formats = explode('|', $this->assignment->data_type);
    }

    public function render()
    {
        return view('livewire.assignment-detail-stats-card');
    }
}
