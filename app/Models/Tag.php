<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * The jobs that belong to the tag.
     */
    public function jobs(): BelongsToMany
    {
        // FIX: Specify the pivot table name ('job_listing_tag') as the second argument.
        // The third argument is the foreign key on the pivot table for the current model.
        // The fourth argument is the foreign key on the pivot table for the related model.
        return $this->belongsToMany(\App\Models\Job::class, 'job_listing_tag', 'tag_id', 'job_listing_id');
    }
}
