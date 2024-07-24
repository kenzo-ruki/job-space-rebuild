<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\JobRepository;
use Carbon\Carbon;

class JobSearchController extends Controller
{
    private $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $jobType = Session::get('search_form_data.job_type');
        $jobs = $this->jobRepository->getJobs();

        return view('jobs.index', compact('jobs'));
    }

    public function single(Job $job)
    {
        if ($job->expired < Carbon::now()) {
            $user = auth()->user();
            if (!$user || ($user->recruiter_id !== $job->recruiter_id)) {
                return redirect('/jobs');
            }
        }
        $job = Job::with('jobCategories', 'city', 'zone', 'recruiter', 'images')->where('job_id', $job->job_id)->first();

        return view('jobs.single', ['job' => $job]);
    }

    public function search(Request $request)
    {
        $category = $request->input('category');
        $subCategory = $request->input('sub_category');
        $location = $request->input('location');
        $keywords = $request->input('keywords');
        $salary_40 = $request->input('salary_40');
        $salary_60 = $request->input('salary_60');
        $salary_80 = $request->input('salary_80');
        $salary_100 = $request->input('salary_100');

        Session::put('search_form_data', [
            'category' => $category,
            'sub_category' => $subCategory,
            'location' => $location,
            'keywords' => $keywords,
            'salary_40' => $salary_40,
            'salary_60' => $salary_60,
            'salary_80' => $salary_80,
            'salary_100' => $salary_100,
        ]);

        if ($category && $subCategory && $location && $keywords) {
            return redirect()->route('jobs.subCategoryLocationKeyword', ['category' => $category, 'sub_category' => $subCategory, 'location' => $location, 'keywords' => $keywords]);
        } elseif ($category && $subCategory && $location) {
            return redirect()->route('jobs.subCategoryLocation', ['category' => $category, 'sub_category' => $subCategory, 'location' => $location]);
        } elseif ($category && $subCategory && $keywords) {
            return redirect()->route('jobs.subCategoryKeyword', ['category' => $category, 'sub_category' => $subCategory, 'keywords' => $keywords]);
        } elseif ($category && $subCategory) {
            return redirect()->route('jobs.subCategory', ['category' => $category, 'sub_category' => $subCategory]);
        } elseif ($category && $location && $keywords) {
            return redirect()->route('jobs.categoryLocationKeyword', ['category' => $category, 'location' => $location, 'keywords' => $keywords]);
        } elseif ($category && $location) {
            return redirect()->route('jobs.categoryLocation', ['category' => $category, 'location' => $location]);
        } elseif ($category && $keywords) {
            return redirect()->route('jobs.categoryKeyword', ['category' => $category, 'keywords' => $keywords]);
        } elseif ($category) {
            return redirect()->route('jobs.category', ['category' => $category]);
        } elseif ($location && $keywords) {
            return redirect()->route('jobs.locationKeyword', ['location' => $location, 'keywords' => $keywords]);
        } elseif ($location) {
            return redirect()->route('jobs.location', ['location' => $location]);
        } elseif ($keywords) {
            return redirect()->route('jobs.keywords', ['keywords' => $keywords]);
        } else {
            return redirect()->route('jobs');
        }
    }

    public function keywords($keywords)
    {
        $jobs = $this->jobRepository->getJobs(null, false, null, $keywords);
        $jobType = Session::get('search_form_data.job_type');
        if ($jobType) {
            $jobs = $jobs->when($jobType, function ($query) use ($jobType) {
                return $query->where('job_type', 'like', "%$jobType%");
            });
        }

        return view('jobs.index', compact('jobs'));
    }

    public function location($location)
    {
        list($keyString, $key) = $this->jobRepository->getLocation($location);
        $jobs = Job::where($keyString, $key);
        $jobType = Session::get('search_form_data.job_type');
        if ($jobType) {
            $jobs = $jobs->when($jobType, function ($query) use ($jobType) {
                return $query->where('job_type', 'like', "%$jobType%");
            });
        }
        $keywords = Session::get('search_form_data.keywords');
        if ($keywords) {
            $jobs = $jobs->when($keywords, function ($query) use ($keywords) {
                return $query->where('job_description', 'like', "%{$keywords}%");
            });
        }
        $jobs = $this->jobRepository->applyFilters($jobs);

        return view('jobs.index', compact('jobs'));
    }

    public function category(JobCategory $category)
    {
        $jobs = $this->jobRepository->getJobs($category);
        Session::put('search_form_data.category', $category->slug);

        return view('jobs.index', compact('jobs'));
    }

    public function categoryKeyword(JobCategory $category, $keywords)
    {
        $jobs = $this->jobRepository->getJobs($category, false, null, $keywords);
        Session::put('search_form_data.category', $category->slug);
        Session::put('search_form_data.keywords', $keywords);

        return view('jobs.index', compact('jobs'));
    }

    public function categoryLocation(JobCategory $category, $location)
    {
        $jobs = $this->jobRepository->getJobs($category, $location);
        Session::put(['search_form_data.category' => $category->slug]);

        return view('jobs.index', compact('jobs'));
    }

    public function categoryLocationKeyword(JobCategory $category, $location, $keywords)
    {
        $jobs = $this->jobRepository->getJobs($category, $location, null, $keywords);
        Session::put('search_form_data.category', $category->slug);
        Session::put('search_form_data.location', $location);
        Session::put('search_form_data.keywords', $keywords);

        return view('jobs.index', compact('jobs'));
    }

    public function subCategory(JobCategory $category, JobSubCategory $subCategory)
    {
        $jobs = $this->jobRepository->getJobs($category, false, $subCategory);
        Session::put([
            'search_form_data.category' => $category->slug,
            'search_form_data.sub_category' => $subCategory->slug
        ]);

        return view('jobs.index', compact('jobs'));
    }

    public function subCategoryKeyword(JobCategory $category, JobSubCategory $subCategory, $keywords)
    {
        $jobs = $this->jobRepository->getJobs($category, false, $subCategory, $keywords);
        Session::put([
            'search_form_data.category' => $category->slug,
            'search_form_data.sub_category' => $subCategory->slug,
            'search_form_data.keywords' => $keywords,
        ]);

        return view('jobs.index', compact('jobs'));
    }

    public function subCategoryLocation(JobCategory $category, JobSubCategory $subCategory, $location)
    {
        $jobs = $this->jobRepository->getJobs($category, $location, $subCategory);
        Session::put([
            'search_form_data.category' => $category->slug,
            'search_form_data.sub_category' => $subCategory->slug,
            'search_form_data.location' => $location,
        ]);

        return view('jobs.index', compact('jobs'));
    }

    public function subCategoryLocationKeyword(JobCategory $category, JobSubCategory $subCategory, $location, $keywords)
    {
        $jobs = $this->jobRepository->getJobs($category, $location, $subCategory, $keywords);
        Session::put([
            'search_form_data.category' => $category->slug,
            'search_form_data.sub_category' => $subCategory->slug,
            'search_form_data.location' => $location,
            'search_form_data.keywords' => $keywords,
        ]);

        return view('jobs.index', compact('jobs'));
    }

    public function getAllFeedItems()
    {
        $jobs = Job::with('city', 'country', 'zone', 'jobType', 'jobCategories', 'jobSubCategories')
            ->whereDate('re_adv', '<=', Carbon::now())
            ->whereDate('expired', '>', Carbon::now())
            ->orderBy('re_adv', 'desc')
            ->get();
        return $jobs;
    }
}