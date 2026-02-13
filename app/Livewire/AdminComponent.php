<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

 #[Layout('components.layouts.admin')]
class AdminComponent extends Component
{

   
    public function render()
    {
        return view('livewire.dashboard');
    }
}
