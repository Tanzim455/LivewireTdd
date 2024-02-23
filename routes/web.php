<?php

use App\Http\Controllers\JobShowController;
use App\Livewire\Counter;
use App\Livewire\CreateJob;
use App\Livewire\JobList;
use App\Livewire\UpdateJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 Route::get('jobs/create',CreateJob::class)->name('jobs.create');

 Route::get('jobs',JobList::class)->name('jobs.index');

//  Route::get('job/{title}',function(){
//    echo "Job Show";
//  })->name('job.show');

 Route::get('job/{job}',[JobShowController::class,'show'])->name('job.show');

 Route::get('job/edit/{job}',UpdateJob::class)->name('job.edit');

 Route::get('counter',Counter::class);