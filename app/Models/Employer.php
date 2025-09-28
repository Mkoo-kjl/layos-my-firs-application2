<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    // Optional: explicitly define table
    protected $table = 'employers';

    // Columns that can be mass-assigned
    protected $fillable = ['name'];

    // One-to-Many: an employer can have many jobs
    public function jobs()
    {
        return $this->hasMany(\App\Models\Job::class, 'employer_id');
    }
}
