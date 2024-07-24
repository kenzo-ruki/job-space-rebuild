<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobType;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobseeker_id',
        'title',
        'objective',
        'job_type_id',
        'job_category',
        'relocate',
        'photo',
        'resume_text',
        'resume',
        'searchable',
        'country',
        'region',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function jobCategory()
    {
        return $this->hasMany(JobCategory::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
