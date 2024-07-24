<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobImage;
use Carbon\Carbon;

class JobPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:recruiter');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('recruiter.job-post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $job = Job::find($id);
        return view('recruiter.job-post.show', ['job' => $job]);
    }
    
    /**
     * Display the specified resource.
     */
    public function questions(string $id)
    {
        //
        $job = Job::find($id);
        return view('recruiter.job-post.questions', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $job = Job::with('jobCategories', 'jobSubCategories', 'images')->find($id);
        return view('recruiter.job-post.edit', ['job' => $job]);
    }

    public function copy(string $id)
    {
        $job = Job::with('jobCategories', 'jobSubCategories', 'images')->find($id);
        $jobCopy = $job->copy();
        return redirect()->route('job.edit', [$jobCopy->job_id]);
    }

    public function expire(string $id)
    {
        $job = Job::with('jobCategories', 'jobSubCategories', 'images')->find($id);
        $job->expired = now();
        $job->save();
        return redirect()->route('job.edit', [$job->job_id]);
    }

    public function all(Request $request)
    {
        $recruiter = auth()->user()->recruiter;
        $jobs = Job::where('recruiter_id', '=', $recruiter?->recruiter_id);

        // Get the search query from the request
        $search = $request->get('search');
        if ($search) {
            // If there's a search query, filter the jobs
            $jobs = $jobs->where('job_title', 'like', '%' . $search . '%');
        }

        $jobs = $jobs->orderBy('created_at', 'desc');
        $allJobs = $jobs->paginate(12);

        // Append the search query to the pagination links
        if ($search) {
            $allJobs->appends(['search' => $search]);
        }

        return view('recruiter.all-jobs.all', [ 'allJobs' => $allJobs ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $resumeId)
    {
        //
        $resume = Job::query()
            ->where('id', '=', $resumeId)
            ->first();
        $resume->delete();
        return redirect('/jobseeker/dashboard');
    }
}
