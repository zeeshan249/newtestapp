<?php

namespace App\Livewire;

use Livewire\Attributes\Title;

class Dashboard extends AdminComponent
{
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.dashboard');
    }
}
