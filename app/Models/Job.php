<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Import for type hinting

class Job extends Model
{
    use HasFactory;

    // By convention, Laravel assumes a 'jobs' table. 
    // We need to tell it to use our 'job_listings' table instead. 
    protected $table = 'job_listings';

    protected $fillable = [
    'title',
    'description', // Make sure this is here!
    'salary',
    'employer_id'
    ];

    public function employer()
    {
        return $this->belongsTo(\App\Models\Employer::class);
    }
    
    /**
     * The tags that belong to the job.
     */
    public function tags(): BelongsToMany
    {
        // FIX: Specify the pivot table name ('job_listing_tag') as the second argument.
        // The foreignPivotKey is already correctly defined.
        return $this->belongsToMany(\App\Models\Tag::class, 'job_listing_tag', foreignPivotKey: "job_listing_id");
    }
}
