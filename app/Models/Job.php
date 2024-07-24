<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Illuminate\Support\Carbon;
use App\Repositories\JobRepository;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasSEO;
    use HasFactory;
    use LogsActivity;

    public $asYouType = true;

    protected $table = 'jobs';

    protected $primaryKey = 'job_id';

    protected $fillable = [
        'display_id',
        'recruiter_id',
        'job_source',
        'created_at',
        'updated_at',
        'deleted_at',
        'unpublished',
        'date',
        're_adv',
        'expired',
        'job_title',
        'job_reference',
        'job_country_id',
        'job_state_id',
        'job_city_id',
        'job_state',
        'job_location',
        'salary_from',
        'salary_to',
        'salary_description',
        'job_short_description',
        'job_description',
        'job_type',
        'job_vacancy_period',
        'job_status',
        'job_featured',
        'job_email_to',
        'url',
        'job_auto_renew',
        'video_link'
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        're_adv' => 'datetime',
        'expired' => 'datetime',
        'unpublished' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()  // Only log attributes that have been changed.
            ->logAll() // This will log every attribute in the log.
            ->useLogName('job'); // Name of the log
    }

    public function copy()
    {
        $copied = $this->replicate(); // Replicate the job
        $copied->push(); // Save the replicated job

        // Sync jobCategories
        $copied->jobCategories()->sync($this->jobCategories->pluck('id')->toArray());

        // Sync jobSubCategories
        $copied->jobSubCategories()->sync($this->jobSubCategories->pluck('id')->toArray());

        // Replicate images
        foreach ($this->images as $image) {
            $copiedImage = $image->replicate();
            $copiedImage->job_id = $copied->id;
            $copiedImage->save();
        }

        return $copied;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {

        $this->load('city', 'country', 'zone', 'recruiter', 'jobType', 'jobCategories', 'jobSubCategories');

        return [
            'job_id' => $this->job_id,
            'job_title' => $this->job_title,
            'job_short_description' => $this->job_short_description,
            'job_description' => $this->job_description,
            'city' => $this->city?->city_name,
            'country' => $this->country?->name,
            'zone' => $this->zone?->zone_name,
            'recruiter' => $this->recruiter?->recruiter_company_name,
            'job_type' => $this->jobType?->job_type_name,
            'job_categories' => $this->jobCategories?->pluck('category_name')->implode(' '),
            'job_sub_categories' => $this->jobSubCategories?->pluck('sub_category_name')->implode(' '),
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'job_city_id', 'city_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'job_country_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'job_state_id');
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id', 'recruiter_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type');
    }

    public function jobCategories()
    {
        return $this->belongsToMany(JobCategory::class, 'job_job_category', 'job_id', 'job_category_id');
    }

    public function jobSubCategories()
    {
        return $this->belongsToMany(JobSubCategory::class, 'job_job_sub_category', 'job_id', 'job_sub_category_id');
    }

    public function images()
    {
      return $this->hasMany(JobImage::class, 'job_id');
    }

    public function jobQuestions()
    {
      return $this->hasMany(JobQuestion::class, 'job_id');
    }

    public function jobStatistics()
    {
        return $this->hasOne(JobStatistics::class, 'job_id');
    }

    public function excerpt($length = 50)
    {
        $excerpt = $this->job_short_description? $this->job_short_description : $this->job_description;
        return Str::words(strip_tags($excerpt), $length, '...');
    }

    public function relatedJobsByCategory()
    {
        $jobs = Job::whereHas('jobCategories', function ($query) {
                $catIds = $this->jobCategories()->pluck('job_category.id')->all();
                $query->whereIn('job_category.id', $catIds);
            })->whereDate('created_at', '<=', Carbon::now())
                ->whereDate('expired', '>', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->where('job_id', '<>', $this->job_id)->take(3)->get();
        if ($jobs->count() < 3) {
            $jobRepository = new JobRepository();
            $jobs = $jobRepository->getFeaturedJobs();
        }
        return $jobs;
    }

    public function applications() {
        return $this->hasMany(Application::class, 'job_id');
    }
}
