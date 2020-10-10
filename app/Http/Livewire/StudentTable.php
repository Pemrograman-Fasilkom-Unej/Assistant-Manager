<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\User;
use App\Repositories\UserRepository;
use Livewire\Component;
use Livewire\WithPagination;

class StudentTable extends Component
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
        $students = UserRepository::getStudents($this->search)->paginate(10);
        return view('livewire.student-table', compact('students'));
    }
}
