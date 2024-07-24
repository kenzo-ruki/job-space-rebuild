<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    protected $fillable = [
        'job_id',
        'recruiter_id',
        'question',
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }
}
