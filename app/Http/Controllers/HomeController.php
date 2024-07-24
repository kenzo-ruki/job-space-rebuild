<?php

namespace App\Http\Controllers;

use App\Repositories\JobRepository;

class HomeController extends Controller
{
    private $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    //
    public function index()
    {
        // Check if the cookie 'has_seen_banner' exists
        $showBanner = !request()->hasCookie('has_seen_banner');
        $featuredJobs = $this->jobRepository->getFeaturedJobs();
        return view('home', compact('featuredJobs', 'showBanner'));
    }
}
