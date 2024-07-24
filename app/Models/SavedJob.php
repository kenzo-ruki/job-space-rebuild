<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Job;

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobseeker_id',
        'job_id',
    ];

    /**
     * Define the user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }

    /**
     * Define the saved job relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }
}
