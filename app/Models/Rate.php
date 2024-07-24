<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'plan_type_name',
        'slug',
        'time_period_months',
        'fee',
        'number_of_postable_jobs',
        'jobs_show_as_featured',
        'search_cvs',
        'priority',
        'plan_description',
    ];
}
