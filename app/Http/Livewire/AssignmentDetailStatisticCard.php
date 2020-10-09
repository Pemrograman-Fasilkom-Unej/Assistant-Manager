<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AssignmentDetailStatisticCard extends Component
{
    public $assignment;
    public $chartLabel;
    public $chartValue;

    public function mount()
    {
        $this->renderChart();
    }

    public function renderChart()
    {
        $chartData = $this->assignment->submissions->groupBy(function ($q) {
            return $q->created_at->format('d M');
        })->map(function ($value, $key) {
            return $value->count();
        })->reverse()->toArray();

        $this->chartLabel = array_keys($chartData);
        $this->chartValue = array_values($chartData);
    }

    public function render()
    {
        return view('livewire.assignment-detail-statistic-card');
    }
}
