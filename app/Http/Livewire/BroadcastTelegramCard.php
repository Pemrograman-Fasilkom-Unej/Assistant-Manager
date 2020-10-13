<?php

namespace App\Http\Livewire;

use App\Repositories\ClassroomRepository;
use Livewire\Component;

class BroadcastTelegramCard extends Component
{
    public $classrooms;

    public function mount()
    {
        $this->classrooms = ClassroomRepository::getAssistantClassroom()->active()->get();
    }

    public function render()
    {
        return view('livewire.broadcast-telegram-card');
    }
}
