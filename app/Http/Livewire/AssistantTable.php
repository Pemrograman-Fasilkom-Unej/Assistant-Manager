<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\User;
use Livewire\Component;
use App\Traits\LivewireTableComponent;

class AssistantTable extends LivewireTable
{
    public $assistants;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->total = User::role('assistant')->count();
        $this->getData();
    }

    public function getData()
    {
        $query = User::role('assistant');
        $search = $this->search;
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
            $this->total = $query->count();
        } else {
            $this->total = User::role('assistant')->count();
        }
        $this->assistants = $query
            ->skip(($this->currentPage - 1) * $this->limit)
            ->limit($this->limit)
            ->get();
        $this->totalPage = ceil($this->total / $this->limit);
    }

    public function render()
    {
        return view('livewire.assistant-table');
    }
}
