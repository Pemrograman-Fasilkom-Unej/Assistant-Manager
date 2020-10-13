<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileInformationCard extends Component
{
    use WithFileUploads;

    public $name;
    public $username;
    public $telegram_id;
    public $email;
    public $avatar;
    public $avatar_url;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->telegram_id = $user->telegram_id;
        $this->email = $user->email;
        $this->avatar_url = $user->profile_photo_url;
    }

    public function save()
    {
        $this->validate([
            'email' => 'nullable|email',
            'avatar' => 'nullable|image|max:1024'
        ]);

        $user = Auth::user();
        if ($this->avatar) {
            $user->updateProfilePhoto($this->avatar);
        }

        Auth::user()->update([
            'email' => $this->email
        ]);

        $this->emit('alert', [
            'type' => 'success',
            'message' => 'User Information has been updated!'
        ]);
    }

    public function render()
    {
        return view('livewire.profile-information-card');
    }
}
