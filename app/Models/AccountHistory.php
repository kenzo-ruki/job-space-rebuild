<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountHistory extends Model 
{
    protected $table = 'account_history';
    
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'recruiter_id',
        'order_id',
        'inserted',
        'updated',
        'plan_type_name',
        'plan_for',
        'start_date',
        'end_date',
        'recruiter_job',
        'recruiter_cv_status',
        'recruiter_cv',
        'job_enjoyed',
        'cv_enjoyed',
        'featured_job'
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function isActive()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }
}
