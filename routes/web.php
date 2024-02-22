<?php

use App\Livewire\CreateJob;
use App\Livewire\JobList;
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