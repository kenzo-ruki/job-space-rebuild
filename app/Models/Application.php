<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Job;
use App\Models\Resume;
use App\Models\JobQuestionResponse;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'job_id',
        'jobseeker_id',
        'cover_letter',
        'resume_id',
        'status',
        'applicant_select',
        'applicant_join_status',
        'selected_date'
    ];

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function jobQuestionResponses()
    {
      return $this->hasMany(JobQuestionResponse::class, 'application_id');
    }

    public function interactions()
    {
        return $this->hasMany(ApplicantInteraction::class);
    }
}
