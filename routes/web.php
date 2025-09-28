<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;
use App\Models\Employer; 
use App\Models\Tag;      

// Homepage
Route::get('/', function () {
    return view('home');
});

// All Jobs
Route::get('/jobs', function () {
    return view('jobs.index', [
        'jobs' => \App\Models\Job::with('employer')->latest()->paginate(3)
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create', [
        'employers' => Employer::all(),
        'tags' => Tag::all()

    ]);
});

// Single Job - using wildcard
Route::get('/jobs/{id}', function ($id) {
    return view('jobs.show', [
        'job' => Job::find($id)
    ]);
});

// In routes/web.php (or your JobController store method)
// Store a New Job
Route::post('/jobs', function () {
    $attributes = request()->validate([
        'title' => ['required', 'min:3'],
        // Add validation for the new description field
        'description' => ['required', 'min:10'], 
        'salary' => ['required'],
        'employer_id' => ['required', 'exists:employers,id'],
        'tags' => ['nullable', 'array'],
        'tags.*' => ['exists:tags,id'],
    ]);

    // Create the job
    $job = \App\Models\Job::create([
        'title' => $attributes['title'],
        'description' => $attributes['description'], // Pass the new description
        'salary' => $attributes['salary'],
        'employer_id' => $attributes['employer_id'],
    ]);

    // Attach tags
    if (isset($attributes['tags'])) {
        $job->tags()->sync($attributes['tags']); 
    }

    return redirect('/jobs');
});

Route::get('/jobs/{job}/edit', function (Job $job) {
    return view('jobs.edit', [
        'job' => $job,
        'employers' => Employer::all(),
        'tags' => Tag::all()
    ]);
});

// Update Job
Route::patch('/jobs/{job}', function (Job $job) {
    $attributes = request()->validate([
        'title' => ['required', 'min:3'],
        'description' => ['required', 'min:10'],
        'salary' => ['required'],
        'employer_id' => ['required', 'exists:employers,id'],
        'tags' => ['nullable', 'array'],
        'tags.*' => ['exists:tags,id'],
    ]);

    // Update job
    $job->update([
        'title' => $attributes['title'],
        'description' => $attributes['description'],
        'salary' => $attributes['salary'],
        'employer_id' => $attributes['employer_id'],
    ]);

    // Sync tags
    if (isset($attributes['tags'])) {
        $job->tags()->sync($attributes['tags']);
    } else {
        $job->tags()->detach(); // clear tags if none selected
    }

    return redirect('/jobs/' . $job->id);
});

Route::delete('/jobs/{job}', function (Job $job) { 
    $job->delete(); 
    return redirect('/jobs'); 
}); 

   

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::patch('jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');

