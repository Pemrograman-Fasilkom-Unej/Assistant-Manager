<?php

namespace App\Http\Livewire;

use App\Repositories\ClassroomRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentEditCard extends Component
{
    public $assignment;
    public $classroom;
    public $formats;
    public $storeUrl;

    public $selectedFormats;

    public function mount()
    {
        $this->classroom = $this->assignment->classroom;
        $this->formats = ['pdf', 'zip', 'rar', 'docx', 'txt', 'jpg', 'png', 'jpeg', 'doc'];
        $this->storeUrl = Auth::user()->hasRole('admin') ? route('dashboard.admin.assignment.update', $this->assignment) : route('dashboard.assistant.assignment.update', $this->assignment);
        $this->selectedFormats = explode('|', $this->assignment->data_type);
    }

    public function render()
    {
        return view('livewire.assignment-edit-card');
    }
}
