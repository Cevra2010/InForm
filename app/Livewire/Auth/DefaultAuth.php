<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DefaultAuth extends Component
{
    public string $username;
    public string $password;
    public function render()
    {
        return view('livewire.auth.default-auth');
    }

    public function submit() {
        if(!Auth::attempt(['username' => $this->username, 'password' => $this->password]))
        {
            $this->addError('username',null);
            $this->addError('password',null);
            $this->addError('invalid','Benutzername und/oder Passwort nicht korrekt');
        }
        else {
            return redirect()->route('backend.dashboard');
        }
    }
}
