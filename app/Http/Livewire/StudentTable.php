<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentTable extends Component
{
    public $students;
    public $currentPage = 1;
    public $firstPage = 1;
    public $limit = 10;
    public $total;
    public $totalPage;
    public $search;

    public function mount()
    {
        $this->total = User::role('student')->count();
        $this->getStudents();
    }

    public function getStudents()
    {
        $query = User::role('student');
        $search = $this->search;
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
            $this->total = $query->count();
        } else {
            $this->total = User::role('student')->count();
        }
        $this->students = $query
            ->skip(($this->currentPage - 1) * $this->limit)
            ->limit($this->limit)
            ->get();
        $this->totalPage = ceil($this->total / $this->limit);
    }

    public function next()
    {
        $this->currentPage++;
        $this->getStudents();
    }

    public function previous()
    {
        $this->currentPage--;
        $this->getStudents();
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
        $this->getStudents();
    }

    public function render()
    {
        return view('livewire.student-table');
    }
}
