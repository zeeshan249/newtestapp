<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditTask extends Component
{
     #[Validate('required')]
    public $name='';

    #[Validate('required|email')]
    public $email='';

    #[Validate('required|max:10|min:10')]
    public $phone='';

    public $is_completed = false;
    public $has_multiple = false;

    public $notifications = [];
    public ?Task $task;
    
    public function mount(Task $task)
    {  
        $this->name = $task->name;
        $this->email = $task->email;
        $this->phone = $task->phone;
        $this->is_completed = (bool)$task->is_completed;
        $this->has_multiple = (bool)$task->has_multiple;
    
       if($task->has_multiple == 1){
       $this->notifications =!empty($task->notifications)
                ? json_decode($task->notifications)
                : null;
       }
       else{
        $this->notifications = [];
       }
    
      

        $this->task = $task;
    }

      public function save(){
       
        $this->validate();

        $this->task->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'is_completed'=>$this->is_completed,
            'has_multiple'=>$this->has_multiple,
            'notifications'=>!empty($this->notifications) && ($this->has_multiple == 1)
                ? json_encode($this->notifications)
                : null
        ]);
        
    session()->flash('success', 'Task Updated successfully!');

    return $this->redirectRoute('tasks', navigate: true);

    }

    public function render()
    { 
       
        return view('livewire.edit-task');
    }
}
