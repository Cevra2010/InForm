<?php

namespace App\Livewire\Auth;

use App\AuthManager\AuthRegistry;
use App\AuthManager\Exceptions\AuthMethodNotFoundException;
use Livewire\Component;

class Login extends Component
{


    public string|null $authMethod = null;
    public array $authMethods;

    public string|null $authMethodView = null;

    public function mount() {
        if($method = session()->get('selected-auth-method')) {
            $this->selectAuthOption($method);
        }
    }

    public function render()
    {
        return view('livewire.auth.login',[
            'methods' => AuthRegistry::getAllAuthMethods(),
        ]);
    }

    public function selectAuthOption($option) {
        try {
            $this->authMethod = $option;
            $this->authMethodView = AuthRegistry::getView($this->authMethod);
            session()->put('selected-auth-method',$this->authMethod);
        }
        catch(AuthMethodNotFoundException $exception) {
            session()->flash('error','Die gewählte Anmeldeoption steht aktuell nicht zur Verfügung.');
        }
    }

    public function resetSelectedAuthMethod() {
        session()->forget('selected-auth-method');
        $this->authMethod = null;
        $this->authMethodView = null;
    }
}
