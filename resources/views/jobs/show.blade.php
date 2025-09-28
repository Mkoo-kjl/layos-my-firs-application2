<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <p class="mb-4">
        <a href="/jobs" class="text-white hover:text-gray-200 font-medium hover:underline transition">
            &larr; Back to Jobs List
        </a>
    </p>
    
    <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-md">
        
        {{-- CONSOLIDATED JOB HEADER --}}
        <h2 class="font-bold text-2xl text-gray-800 mb-1">{{ $job->title }}</h2>
        <p class="text-md text-gray-600 mb-4">{{ $job->employer->name }}</p>

        <p class="text-xl font-semibold text-green-600 mb-4">
            Pays {{ $job->salary }} per year.
        </p>
        
        {{-- DESCRIPTION --}}
        <h3 class="font-semibold text-lg border-t pt-4 mt-4">Description</h3>
        <p class="mt-2 text-gray-700">{{ $job->description }}</p>
        
        {{-- TAGS SECTION --}}
        <div class="mt-4 pt-4 border-t">
            <h3 class="font-semibold text-lg mb-2"></h3>
            @foreach ($job->tags as $tag)
                <span style="
                    display: inline-block;
                    background-color: #e0f2f1; 
                    color: #00897b; 
                    padding: 4px 10px; 
                    margin-right: 8px; 
                    margin-bottom: 8px;
                    border-radius: 4px;
                    font-size: 0.875rem;
                    font-weight: 500;
                ">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        {{-- CALL TO ACTION / ACTIONS --}}
        <div class="mt-6 pt-4 border-t flex justify-end">
            
            {{-- This button links to the edit form, as per Chapter 6 instructions --}}
            <a href="/jobs/{{ $job->id }}/edit" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-150 ease-in-out mr-2">
                Edit Job
            </a>
        <form method="POST" action="/jobs/{{ $job->id }}" id="delete-job-form">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-150 ease-in-out mr-2"
                    onclick="return confirm('Are you sure you want to delete this job?');">
                    Delete Job
                </button>
        </form>
            <a href="/jobs/{{ $job->id }}/apply" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-150 ease-in-out">
                Apply Now &rarr;
            </a>
        </div>
    </div>

</x-layout>