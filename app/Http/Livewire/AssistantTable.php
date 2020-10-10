<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\User;
use App\Repositories\UserRepository;
use Livewire\Component;
use App\Traits\LivewireTableComponent;
use Livewire\WithPagination;

class AssistantTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $assistants = UserRepository::getAssistants($this->search)->paginate(10);
        return view('livewire.assistant-table', compact('assistants'));
    }
}
