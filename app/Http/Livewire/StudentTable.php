<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\User;
use Livewire\Component;

class StudentTable extends LivewireTable
{
    public $students;

    public function mount()
    {
        $this->total = User::role('student')->count();
        $this->getData();
    }

    public function getData()
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

    public function render()
    {
        return view('livewire.student-table');
    }
}
