<x-layout>
    <x-slot:heading>
        Edit a Job
    </x-slot:heading>

    <div class="max-w-3xl mx-auto p-10 bg-white shadow-2xl rounded-xl border border-gray-100">
        
        <form method="POST" action="/jobs/{{ $job->id }}">
            @csrf
            @method('PATCH')

            <div class="border-b border-gray-200 pb-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900">1. Job Basics & Compensation</h2>
                <p class="mt-1 text-sm text-gray-500 mb-6">Enter the title and compensation for the role.</p>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700">Job Title</label>
                        <input id="title" name="title" type="text" required
                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 transition duration-150"
                               {{-- FIX: Use $job->title as fallback for old('title') --}}
                               value="{{ old('title', $job->title) }}"
                               placeholder="e.g., Senior Backend Engineer"
                        >
                        @error('title')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="salary" class="block text-sm font-semibold text-gray-700">Salary (Annual/Range)</label>
                        <input id="salary" name="salary" type="text" required
                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 transition duration-150"
                               {{-- FIX: Use $job->salary as fallback for old('salary') --}}
                               value="{{ old('salary', $job->salary) }}"
                               placeholder="e.g., $100,000 - $120,000"
                        >
                        @error('salary')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200 pb-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900">2. Categorization & Employer</h2>
                <p class="mt-1 text-sm text-gray-500 mb-6">Select the employer and relevant technologies/skills.</p>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    <div>
                        <label for="employer_id" class="block text-sm font-semibold text-gray-700">Select Employer</label>
                        <select id="employer_id" name="employer_id" required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 transition duration-150"
                        >
                            <option value="">-- Choose Company --</option>
                            {{-- Get the currently selected ID, prioritizing old input --}}
                            @php $selectedEmployerId = old('employer_id', $job->employer_id); @endphp
                            
                            {{-- Loop through the collection of companies passed from the controller --}}
                            @foreach ($employers as $employer)
                                <option 
                                    value="{{ $employer->id }}"
                                    {{-- FIX: Compare against the $selectedEmployerId --}}
                                    {{ $selectedEmployerId == $employer->id ? 'selected' : '' }}
                                >
                                    {{ $employer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employer_id')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tags" class="block text-sm font-semibold text-gray-700">Relevant Tags (Hold Ctrl to select multiple)</label>
                        <select id="tags" name="tags[]" multiple required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 transition duration-150 h-32"
                        >
                            {{-- Get old selected tags array, defaulting to an empty array. --}}
                            {{-- FIX: Use $job->tags->pluck('id')->toArray() as the fallback --}}
                            @php $oldTags = old('tags', $job->tags->pluck('id')->toArray()); @endphp 

                            {{-- Loop through the collection of available tags --}}
                            @foreach ($tags as $tag)
                                <option 
                                    value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $oldTags) ? 'selected' : '' }}
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="pb-6">
                <h2 class="text-xl font-bold text-gray-900">3. Role Description</h2>
                <p class="mt-1 text-sm text-gray-500 mb-6">Write a detailed description of the responsibilities.</p>

                <div>
                    <label for="description" class="sr-only">Job Description</label>
                    <textarea id="description" name="description" rows="8" required
                                 class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 transition duration-150"
                                 placeholder="Describe the responsibilities, required skills, and benefits here..."
                    >{{-- FIX: Use $job->description as fallback for old('description') --}}
                    {{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-8 mt-6 flex justify-end space-x-4 border-t border-gray-200">
                
                <a href="/jobs" class="px-6 py-3 text-base font-semibold text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-sm hover:bg-gray-100 transition duration-150">
                    Cancel
                </a>
                
                <button type="submit" class="px-6 py-3 text-base font-semibold text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">Update Job</button>
            </div>
        </form>
    </div>
</x-layout>