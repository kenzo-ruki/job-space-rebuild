<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantInteraction extends Model
{
    use HasFactory;

    protected $table = 'applicant_interaction';

    protected $fillable = [
        'application_id',
        'jobseeker_id',
        'recruiter_id',
        'subject',
        'message',
        'attachment_file',
        'user_see',
        'sender',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'jobseeker_id');
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }

    public function excerpt()
    {
        return substr(strip_tags($this->message), 0, 30) . '...';
    }
}
