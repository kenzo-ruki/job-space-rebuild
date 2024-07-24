<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobCategory;

class SavedSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobseeker_id',
        'title',
        'keywords',
        'location',
        'category',
        'sub_category',
        'job_type',
        'salary_40',
        'salary_60',
        'salary_80',
        'salary_100',
        'company',
        'date_window',
        'frequency',
        'active',
    ];

    /**
     * Define the user saved searches relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_slug', 'slug');
    }

    public function locationable()
    {
        return $this->morphTo();
    }
}
