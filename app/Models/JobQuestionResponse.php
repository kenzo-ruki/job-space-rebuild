<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestionResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'jobseeker_id',
        'question',
        'response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }
}
