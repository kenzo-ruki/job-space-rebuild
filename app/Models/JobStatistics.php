<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatistics extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'job_statistics';

    protected $primaryKey = 'job_id';

    protected $fillable = [
        'job_id',
        'applications',
        'viewed',
        'clicked'
    ];

    public function application()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
