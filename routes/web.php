<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
   
Route::get('/', function () {
    return view ('home');
    
});

// index
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); 
// create
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
// store
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
// show
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
// update
Route::patch('jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
// edit
Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
// destroy
Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');