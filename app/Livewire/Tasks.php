<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Tasks')]
class Tasks extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // important for Bootstrap

    // public $tasks=[];
    public $counter = 1;

    public $filter = '';

    public $selectAll = false;

    #[Validate('required')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|max:10|min:10')]
    public $phone = '';

    public $taskId = '';

    public $task = '';

    public $is_completed = false;

    public $has_multiple = false;

    public $notifications = [];

    public $selectedTasks = [];

    public $selectedTasksAllCheck = false;

    public $currentPageIds = [];

       #[Validate('required')]
    
    public $searchTerm = '';
   

    

    #[On('statusChanged')]
    public function updateFilter($value)
    {
        $this->filter = $value;

        $this->resetPage();
    }

    public function mount()  // This Method doesnt support pagination because it runs only once when the component is initialized. So we will fetch tasks in render method instead of mount method.
    {
        $this->tasks = Task::select('*')->orderBy('created_at', 'desc')->get();
    }

    public function strikeSelected()
    {
        Task::whereIn('id', $this->selectedTasks)
            ->update(['is_completed' => 1]);

        $this->selectedTasks = [];
        $this->selectAll = false;
    }

    public function delete(Task $task)
    {
        $task->delete();
        $this->resetPage(); // Used Only when we are on the last page and we delete the last item of that page then it will automatically take us to the previous page because there is no item to show on the current page.
        session()->flash('success', 'Task deleted successfully!');
        $this->tasks = Task::select('*')->orderBy('created_at', 'desc')->get();
        $this->dispatch('articleDeleted');
    }

    public function editViewModal(Task $task)
    {

        $this->taskId = $task->id;

        $this->name = $task->name;
        $this->email = $task->email;
        $this->phone = $task->phone;
        $this->is_completed = (bool) $task->is_completed;
        $this->has_multiple = (bool) $task->has_multiple;

        $this->notifications = $task->has_multiple
            ? json_decode($task->notifications, true) ?? []
            : [];

        // 🔥 OPEN MODAL PROGRAMMATICALLY
        $this->dispatch('open-edit-modal');
    }

    public function updateModalData()
    {
        $this->validate();

        $task = Task::findOrFail($this->taskId);

        $task->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_completed' => $this->is_completed,
            'has_multiple' => $this->has_multiple,
            'notifications' => (! empty($this->notifications) && $this->has_multiple)
                ? json_encode($this->notifications)
                : null,
        ]);

        session()->flash('success', 'Task updated successfully!');

        // 🔥 Close modal
        $this->dispatch('close-modal');

        // 🔥 Reset form (important)
        $this->reset([
            'taskId',
            'name',
            'email',
            'phone',
            'is_completed',
            'has_multiple',
            'notifications',
        ]);
    }

    public function toggleSelectAll()
    {
        $this->selectAll = ! $this->selectAll;

        $this->selectedTasks = $this->selectAll
            ? $this->currentPageIds
            : [];
    }

    //    public function render()  //selecting all of the ids
    // {
    //     $query = Task::query();

    //     if ($this->filter == 'completed') {
    //         $query->where('is_completed', 1);
    //     }

    //     if ($this->filter == 'pending') {
    //         $query->where('is_completed', 0);
    //     }

    //     // return view('livewire.tasks',[
    //     //  'tasks' => Task::orderBy('created_at','desc')->paginate(10)]);
    //     $this->currentPageIds = $query->pluck('id')->toArray();

    //     return view('livewire.tasks', [
    //         'tasks' => $query->orderBy('created_at', 'desc')->paginate(10)
    //     ]);
    // }

    public function render()  // selecting only the ids of the current page
    {
        $query = Task::query();

        if ($this->filter === 'completed') {
            $query->where('is_completed', 1);
        }

        if ($this->filter === 'pending') {
            $query->where('is_completed', 0);
        }
        if($this->searchTerm){
            $searchTerm = "%{$this->searchTerm}%";
            $query->where('email', 'LIKE', $searchTerm);
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        // Store current page IDs
        $this->currentPageIds = $tasks->pluck('id')->toArray();

        // $this->toggleSelectAll();
        return view('livewire.tasks', [
            'tasks' => $tasks,
        ]);
    }

    //     public function updatedSelectedTasks()
    // {      dd($this->selectedTasksAllCheck,$this->currentPageIds);
    //     $this->selectAll =
    //         count($this->selectedTasksAllCheck) === count($this->currentPageIds);
    // }

    public function updatingPage()
    {
        // dd($this->selectedTasksAllCheck);
        $this->selectedTasksAllCheck = false;
        $this->selectAll = false;
        $this->selectedTasks = [];
    }
}
