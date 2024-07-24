<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAlert extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'jobseeker_id',
        'title',
        'keywords',
        'country',
        'zone',
        'job_category',
        'job_type',
        'job_salary',
        'recruiter_id',
        'frequency',
    ];

    /**
     * Get the user that owns the job alert.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }
}