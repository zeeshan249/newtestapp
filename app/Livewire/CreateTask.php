<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Create Task')]
class CreateTask extends AdminComponent
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
//  $this->allowNotifications = count($this->notifications) > 0;
    public function save(){
  
        $this->validate();
         
        
        Task::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'is_completed'=>$this->is_completed,
            'has_multiple'=>$this->has_multiple,
            'notifications'=>!empty($this->notifications)
                ? json_encode($this->notifications)
                : null
        ]);

    session()->flash('success', 'Task created successfully!');

    return $this->redirectRoute('tasks', navigate: true);

    }
    public function render()
    {
        return view('livewire.create-task');
    }
}
