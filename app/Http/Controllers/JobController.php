<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource (All Jobs)
     */
    public function index()
    {
        return view('jobs.index', [
            'jobs' => Job::with('employer')->latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource (jobs/create)
     */
    public function create()
    {
        return view('jobs.create', [
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage (POST /jobs)
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'salary' => ['required'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $job = Job::create($attributes);

        if (isset($attributes['tags'])) {
            $job->tags()->sync($attributes['tags']); 
        }

        return redirect('/jobs');
    }

    /**
     * Display the specified resource (Single Job)
     */
    public function show(Job $job) // Uses Implicit Route Model Binding
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource (jobs/{job}/edit)
     */
    public function edit(Job $job) // Uses Implicit Route Model Binding
    {
        return view('jobs.edit', [
            'job' => $job,
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage (PATCH /jobs/{job})
     */
    public function update(Job $job) // Uses Implicit Route Model Binding
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'salary' => ['required'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $job->update($attributes);

        // Sync tags
        if (isset($attributes['tags'])) {
            $job->tags()->sync($attributes['tags']);
        } else {
            $job->tags()->detach(); // clear tags if none selected
        }

        return redirect('/jobs/' . $job->id);
    }

    /**
     * Remove the specified resource from storage. (DELETE /jobs/{job})
     */
    // You'll want this method too, even if you didn't define the route.
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}