<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobseeker_id',
        'video_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }
}
