<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{



    public $showLoginForm = true;

    #[Validate('required|email')]
    public $username = '';

    #[Validate('required')]
    public $password = '';

 



    public function submitLoginDetails(){
       
        $this->validate();

        $valid= Auth::attempt(['email'=>$this->username,'password'=>$this->password]);

        if($valid){
            return redirect()->intended('/dashboard');
        }
        else{
          
            
            $this->dispatch('login-failed',message:'Invalid login details',showLoginForm:true);
        }

   

    }
    public function render()
    {
        return view('livewire.login-component');
    }
}
