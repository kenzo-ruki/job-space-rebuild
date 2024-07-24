<?php

namespace App\Repositories;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobSubCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\Zone;
use App\Models\City;
use App\Models\JobAlert;

class JobRepository
{
    private $limit = 12;

    public function getFeaturedJobs()
    {
        $this->limit = 6;
        $jobs = Job::with('jobCategories', 'city', 'zone', 'recruiter')
                ->where('job_featured', '=', 'Yes');
        $this->limit = 12;
        return $this->applyFilters($jobs);
    }

    public function getRecommendedJobs()
    {
        
        $this->limit = 6;
        $jobPreferenceObject = auth()->user()?->jobPreference;
        if (null !== $jobPreferenceObject) {
            $jobPreference = $jobPreferenceObject->toArray();
            $keywords = unserialize($jobPreference['keywords']);
            $locations = unserialize($jobPreference['locations']);
            $categories = unserialize($jobPreference['categories']);
            $jobs = Job::query()->with('jobCategories', 'city', 'zone', 'recruiter');

            // Filter by keywords
            if (!empty($keywords)) {
                $jobs = $jobs->where(function ($query) use ($keywords) {
                    // Limit the terms to 3
                    $keyword_limit = 0;
                    $keywords = array_reverse($keywords); // Reverse the array
                    foreach ($keywords as $keyword) {
                        $keyword_limit++;
                        $query->orWhere('job_title', 'like', '%' . $keyword . '%');
                    }
                });
            }
        
            // Filter by locations
            if (!empty($locations)) {
                $jobs = $jobs->where(function ($query) use ($locations) {
                    // Limit the terms to 3
                    $location_limit = 0;
                    $locations = array_reverse($locations); // Reverse the array
                    foreach ($locations as $location) {
                        if ($location && $location_limit < 3) {
                            $location_limit++;
                            list($keyString, $key) = $this->getLocation($location);
                            $query->orWhere($keyString, $key);
                        }
                    }
                });
            }
        
            // Filter by categories
            if (!empty($categories)) {
                // Fetch all category ids at once
                $categoryIds = JobCategory::whereIn('slug', $categories)->pluck('id');
                $jobs = $jobs->whereHas('jobCategories', function ($query) use ($categoryIds) {
                    $query->whereIn('job_category_id', $categoryIds);
                });
            }
            $recommendedJobs = $this->applyFilters($jobs);
        } else {
            $recommendedJobs = $this->getFeaturedJobs();
        }
        $this->limit = 12;
        return $recommendedJobs;
    }

    public function getJobsByAlertCriteria(JobAlert $jobAlert)
    {
        $jobs = Job::query()->with('jobCategories', 'city', 'zone', 'recruiter');

        // Filter by keywords
        if (!empty($jobAlert->keywords)) {
            $keywords = explode(',', $jobAlert->keywords);
            $jobs = $jobs->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('job_title', 'like', '%' . $keyword . '%');
                }
            });
        }

        // Filter by country
        if (!empty($jobAlert->country)) {
            $jobs = $jobs->where('job_country_id', $jobAlert->country);
        }

        // Filter by zone
        if (!empty($jobAlert->zone)) {
            $jobs = $jobs->where('job_state_id', $jobAlert->zone);
        }

        // Filter by job category
        if (!empty($jobAlert->job_category)) {
            $jobs = $jobs->whereHas('jobCategories', function ($query) use ($jobAlert) {
                $query->where('job_category_id', $jobAlert->job_category);
            });
        }

        // Filter by job type
        if (!empty($jobAlert->job_type)) {
            $jobs = $jobs->where('job_type', $jobAlert->job_type);
        }

        // Filter by recruiter
        if (!empty($jobAlert->recruiter_id)) {
            $jobs = $jobs->where('recruiter_id', $jobAlert->recruiter_id);
        }

        // Filter by frequency
        if (!empty($jobAlert->frequency)) {
            $date = now();
            switch ($jobAlert->frequency) {
                case 'daily':
                    $date->subDay();
                    break;
                case 'weekly':
                    $date->subWeek();
                    break;
                case 'monthly':
                    $date->subMonth();
                    break;
            }
            $jobs = $jobs->where('created_at', '>=', $date);
        }
        return $jobs->get();
    }

    public function getJobs(JobCategory $category = null,  $location = false, JobSubCategory $subCategory = null, $keywords = false)
    {
        $jobType = Session::get('search_form_data.job_type');
        $keywords = Session::get('search_form_data.keywords');
        $salary_40 = Session::get('search_form_data.salary_40');
        $salary_60 = Session::get('search_form_data.salary_60');
        $salary_80 = Session::get('search_form_data.salary_80');
        $salary_100 = Session::get('search_form_data.salary_100');
        Log::info('search_form_data', ['SessionFromData' => Session::get('search_form_data')]);
        $keyString = '';
        $key = '';
        if ($location) {
            list($keyString, $key) = $this->getLocation($location);
        }
        $salary_range = [];
        // Check if each salary limit is set to true and add it to the salary range
        if ($salary_40) {
            $salary_range[] = 40000;
        }
        if ($salary_60) {
            $salary_range[] = 60000;
        }
        if ($salary_80) {
            $salary_range[] = 80000;
        }
        if ($salary_100) {
            $salary_range[] = 100000;
        }
        
        $jobs = Job::query()->with('jobCategories', 'city', 'zone', 'recruiter')
            ->when($subCategory, function ($query, $subCategory) {
                return $query->join('job_job_sub_category', 'jobs.job_id', '=', 'job_job_sub_category.job_id')
                             ->where('job_job_sub_category.job_sub_category_id', '=', $subCategory->id);
            })
            ->when($category, function ($query) use ($category) {
                return $query->join('job_job_category', 'jobs.job_id', '=', 'job_job_category.job_id')
                             ->where('job_job_category.job_category_id', '=', $category->id);
            })
            ->when($jobType, function ($query) use ($jobType) {
                return $query->where('job_type', 'like', "%$jobType%");
            })
            ->when($location, function ($query) use ($keyString, $key) {
                return $query->where($keyString, $key);
            })
            ->when($keywords, function ($query) use ($keywords) {
                return $query->where(function ($query) use ($keywords) {
                    $query->where('job_description', 'like', "%{$keywords}%");
                });
            })
            ->when(!empty($salary_range), function ($query) use ($salary_range) {
                $minSalary = min($salary_range);
                $maxSalary = max($salary_range);

                if ($minSalary == $maxSalary) {
                    return $query->where(function ($query) use ($minSalary) {
                        $query->whereRaw('CAST(salary_from AS UNSIGNED) >= ?', [$minSalary])
                              ->orWhereRaw('CAST(salary_to AS UNSIGNED) >= ?', [$minSalary]);
                    });
                } else {
                    return $query->where(function ($query) use ($minSalary, $maxSalary) {
                        $query->whereRaw('CAST(salary_from AS UNSIGNED) BETWEEN ? AND ?', [$minSalary, $maxSalary])
                              ->orWhereRaw('CAST(salary_to AS UNSIGNED) BETWEEN ? AND ?', [$minSalary, $maxSalary]);
                    });
                }
            });
        //TODO remove logging
        Log::info($jobs->toSql());

        return $this->applyFilters($jobs);
    }

    public function getLocation($location)  {
        $country = Country::where('slug', $location)->first();
        $zone = Zone::where('slug', $location)->first();
        $city = City::where('slug', $location)->first();

        $keyString = '';
        $key = '';
        if ($country) {
            $keyString = 'job_country_id';
            $key = $country->id;
            Session::put('search_form_data.location', $country->slug);
        } elseif ($zone) {
            $keyString = 'job_state_id';
            $key = $zone->zone_id;
            Session::put('search_form_data.location', $zone->slug);
        } elseif ($city) {
            $keyString = 'job_city_id';
            $key = $city->city_id;
            Session::put([
                'search_form_data.location' => $city->slug,
                'search_form_data.sub_location' => $city->slug
            ]);
        }

        return [$keyString, $key];
    }

    public function applyFilters($query)
    {
        return $query->whereDate('re_adv', '<=', Carbon::now())
            ->whereDate('expired', '>', Carbon::now())
            ->orderBy('re_adv', 'desc')
            ->paginate($this->limit);
    }

    public function getAllFeedJobs()
    {
        $jobs = Job::with('city', 'country', 'zone', 'jobType', 'jobCategories', 'jobSubCategories')
            ->whereDate('re_adv', '<=', Carbon::now())
            ->whereDate('expired', '>', Carbon::now())
            ->orderBy('re_adv', 'desc')
            ->get();
        return $jobs;
    }
}
