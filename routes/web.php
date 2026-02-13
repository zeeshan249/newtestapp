<?php

use App\Livewire\Tasks;
use App\Livewire\EditTask;
use App\Livewire\Dashboard;
use App\Livewire\ShowLogin;
use App\Livewire\CreateTask;
use App\Livewire\EditArticle;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/dashboard');
});
Route::get('/login',ShowLogin::class)->name('login');
Route::get('/dashboard',Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('/dashboard/tasks',Tasks::class)->middleware('auth')->name('tasks');
Route::get('/dashboard/tasks/create',CreateTask::class)->middleware('auth')->name('create-task');
Route::get('/dashboard/tasks/{task}/edit',EditTask::class)->middleware('auth')->name('edit-task');

// Route::get('/dashboard',function(){
//     return "Welcome to dashboard";
// })->middleware('auth');