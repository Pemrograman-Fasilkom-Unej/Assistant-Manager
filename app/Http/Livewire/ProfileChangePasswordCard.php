<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ProfileChangePasswordCard extends Component
{
    use PasswordValidationRules;

    public $current_password;
    public $password;
    public $password_confirmation;

    public function save()
    {
        $user = Auth::user();
        $input = [
            'current_password' => $this->current_password,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation
        ];

        $validator = Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $error) {
                $this->emit('alert', [
                    'type' => 'error',
                    'message' => $error
                ]);
            }
            return;
        }

        if (!Hash::check($this->current_password, $user->password)) {
            $this->emit('alert', [
                'type' => 'error',
                'message' => 'The provided password does not match your current password.'
            ]);
            return;
        }

        $user->forceFill([
            'password' => Hash::make($this->password),
        ])->save();

        $this->emit('alert', [
            'type' => 'success',
            'message' => 'Password changed successfully'
        ]);

        $this->reset(['password', 'current_password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.profile-change-password-card');
    }
}
