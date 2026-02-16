<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchComponent extends Component
{
  
    


    #[Validate('required')]
    public $searchTerm = '';
    public $results = [];
    public $placeholder;
    public function render()
    {
        return view('livewire.search-component');
    }
}
