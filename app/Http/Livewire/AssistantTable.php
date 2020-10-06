<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AssistantTable extends Component
{
    public $assistants;
    public $currentPage = 1;
    public $firstPage = 1;
    public $limit = 10;
    public $total;
    public $totalPage;
    public $search;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->total = User::role('assistant')->count();
        $this->getAssistants();
    }

    public function getAssistants()
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

    public function next()
    {
        $this->currentPage++;
        $this->getAssistants();
    }

    public function previous()
    {
        $this->currentPage--;
        $this->getAssistants();
    }

    public function changePage($page)
    {
        $this->currentPage = $page;
        $this->getAssistants();
    }

    public function render()
    {
        return view('livewire.assistant-table');
    }
}
