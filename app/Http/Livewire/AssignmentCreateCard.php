<?php

namespace App\Http\Livewire;

use App\Repositories\ClassroomRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentCreateCard extends Component
{
    public $classrooms;
    public $formats;
    public $storeUrl;

    public function mount()
    {
        $this->classrooms = ClassroomRepository::getUserClassroom();
        $this->formats = ['pdf', 'zip', 'rar', 'docx', 'txt', 'jpg', 'png', 'jpeg', 'doc'];
        $this->storeUrl = Auth::user()->hasRole('admin') ? route('dashboard.admin.assignment.store') : route('dashboard.admin.assignment.store');
    }

    public function render()
    {
        return view('livewire.assignment-create-card');
    }
}
