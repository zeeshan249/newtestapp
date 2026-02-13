<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class ShowLogin extends Component
{
    
    #[Title('Login')]

    #[Layout('components.layouts.app')]
    
    public $loginMessage='';
     
    #[On('login-failed')]
    public function handleLoginFailed($message){
        $this->loginMessage = $message;
    }

    public function render()
    {
        return view('livewire.show-login');
    }
}
