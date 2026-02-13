<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

#[Lazy]
class TotalCount extends Component
{
    public $totalCount = 0;

     #[On('articleDeleted')]
    public function refreshCount()
    {
        // This method will run when event fires
       // $this->totalCount = Task::count();
        if ($this->totalCount > 0) {
            $this->totalCount--;
        }
    }
    public function mount(){
       
        $this->totalCount = Task::count();
    }
    public function placeholder(){
        return view('livewire.count-placeholder');
    }
    public function render()
    {
        return view('livewire.total-count');
    }
}
