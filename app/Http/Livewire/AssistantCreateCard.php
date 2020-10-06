<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AssistantCreateCard extends Component
{
    public $name = '';
    public $students = [];
    public $search = '';
    public $user_ids = [];
    public $user_names = [];

    public function getStudent()
    {
        $search = $this->search;
        if ($search) {
            $this->students = User::role('student')
                ->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
                })
                ->limit(10)
                ->get();
        }
    }

    public function addStudent($id, $name)
    {
        array_push($this->user_ids, $id);
        array_push($this->user_names, $name);
    }

    public function deleteStudent($id)
    {
        unset($this->user_ids[$id]);
        unset($this->user_names[$id]);
    }

    public function submit()
    {
        User::whereIn('id', $this->user_ids)->get()->each(function ($user) {
            $user->assignRole('assistant');
        });

        $this->redirect(route('dashboard.admin.assistant.index'));
    }

    public function render()
    {
        return view('livewire.assistant-create-card');
    }
}
