<?php

use App\Models\JobType;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

if (! function_exists('getJobTypes')) {

    /**
     * Get the job types based on the given job type IDs.
     *
    * @param string $jobTypeIds The comma-separated job type IDs.
     *
     * @return array The array of job type names.
     */
    function getJobTypes($jobTypeIds)
    {
        $ids = explode(',', $jobTypeIds);

        return JobType::whereIn('id', $ids)->pluck('type_name')->toArray();
    }
}

if (! function_exists('getJobLocation')) {
    /**
     * Get the location of a job.
     *
     * @param mixed $job The job object.
     *
     * @return string The location of the job.
     */
    function getJobLocation($job)
    {
        $locationParts = [];
    
        if ($job?->job_location) {
            return $job->job_location;
        }
    
        if ($job?->city) {
            $locationParts[] = $job->city->city_name;
        }
    
        if ($job?->zone) {
            $locationParts[] = $job->zone->zone_name;
        }
    
        // Check if there's only one element in the array
        if (count($locationParts) === 1) {
            return $locationParts[0];
        }
    
        return implode(', ', $locationParts);
    }
}

if (! function_exists('getJobCategory')) {
    /**
     * Get the location of a job.
     *
     * @param mixed $job The job object.
     *
     * @return string The location of the job.
     */
    function getJobCategory($job)
    {
        $categoryParts = [];
    
        if ($job?->job_category) {
            $categoryParts[] = $job->job_category->category_name;
        }
    
        if ($job?->job_sub_category) {
            $categoryParts[] = $job->job_sub_category->sub_category_name;
        }
    
        // Check if there's only one element in the array
        if (count($categoryParts) === 1) {
            return $categoryParts[0];
        }
    
        return implode(', ', $categoryParts);
    }
}

if (! function_exists('getJobExcerpt')) {
    /**
     * Get the excerpt of a job.
     *
     * @param mixed $job The job object.
     *
     * @return string The exceprt of the job.
     */
    function getJobExcerpt($job)
    {
        return $job?->job_short_description ? strip_tags($job->job_short_description) : Str::words(strip_tags($job->job_description), 50, '...');
    }
}

if (! function_exists('getJobCreatedAt')) {
    /**
     * Get the human readable time difference for the creation time of the job.
     * It will return a string like '3 days ago', '1 month ago', '2 years ago', etc
     *
     * @param mixed $job The job object.
     *
     * @return string The human readable string.
     */
    function getJobCreatedAt($job)
    {
        return Carbon::parse($job->re_adv)->format('d-m-Y');
    }
}

if (! function_exists('getRecruiterLogo')) {
    /**
     * Get recruiter logo or default to site logo.
     *
     * @param mixed $job The job object.
     *
     * @return string The image url.
     */
    function getRecruiterLogo($job)
    {
        if ($job?->recruiter && $job->recruiter?->recruiter_logo) {
            if (Storage::exists('public/recruiter_logo/' . $job->recruiter->recruiter_logo)) {
                return 'public/recruiter_logo/' .  $job->recruiter->recruiter_logo;
            }
        }
        return '/img/logo.png';
    }
}


if (! function_exists('getJobSalary')) {

    /**
     * Get job salary favouring description over from and to.
     *
     * @param mixed $job The job object.
     *
     * @return string The salary in plain text.
     */
    function getJobSalary($job)
    {
        if (!empty($job->salary_description)) {
            return $job->salary_description;
        } elseif (!empty($job->salary_from) && !empty($job->salary_to)) {
            return '$' . $job->salary_from . ' - $' . $job->salary_to;
        } else {
            return false;
        }
    }
}