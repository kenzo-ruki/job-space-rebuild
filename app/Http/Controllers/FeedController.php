<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Jobtype;
use App\Repositories\JobRepository;
use Carbon\Carbon;

class FeedController extends Controller
{
    private $jobRepository;
    private $jobTypes;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->jobTypes = JobType::all()->pluck('type_name', 'id')->toArray();
    }

    public function jobFeed()
    {
        $jobs = $this->jobRepository->getAllFeedJobs();
        $feedItems = array_map([$this, 'toFeedItem'], $jobs->all());
        $meta = [
            'title' => 'Job Feed',
            'description' => 'Job Feed',
            'link' => url('/'),
            'language' => 'en',
            'pubDate' => Carbon::now()->toRfc2822String(),
            'lastBuildDate' => Carbon::now()->toRfc2822String(),
            'ttl' => 60,
            'generator' => 'Laravel',
            'model' => 'job',
        ];
        $view = view('feed.xml', ['feedItems' => $feedItems, 'meta' => $meta]);
        return response($view->render(), 200, ['Content-Type' => 'application/xml']);
    }

    public function toFeedItem(Job $job)
    {
        if ($job->jobCategories->contains('id', 77)) {
            return;
        }
        $salary = $job->salary_from;
        $salary .= $job->salary_to ? " - {$job->salary_to}" : '';
        $salary .= $job->salary_description ? " {$job->salary_description}" : '';        
        $city_name = $job->city()->first()?->city_name;
        $zone_name = $job->zone()->first()?->zone_name;
        $country_name = $job->country()->first()?->name;
        $category_name = $job->jobCategories()->first()?->category_name;
        $recruiter_company_name = $job->recruiter()->first()?->recruiter_company_name;
        $job_type = 'Full Time';
        if ($job->job_type) {
            $job_type_ids = explode(',', $job->job_type);
            $job_type = implode(', ', array_map(function($id) {
                return $this->jobTypes[$id];
            }, $job_type_ids));
        }
        
        return [
            'id'=> $job->job_id,
            'title'=> $job->job_title,
            'date'=> $job->re_adv,
            'referencenumber'=> $job->job_reference,
            'requisitionid'=> $job->job_id,
            'url' => route('jobs.single_id', $job->job_id),
            'company'=> $recruiter_company_name,
            'sourcename'=> $recruiter_company_name,
            'city'=> $city_name,
            'state'=> $zone_name,
            'country'=> $country_name,
            'streetaddress'=> $city_name,
            'email'=> $job->job_email_to,
            'description'=> $job->job_description,
            'salary'=> $salary,
            'jobtype'=> $job_type,
            'category'=> $category_name,
            'expirationdate'=> $job->expired,
        ];
    }

    public function rssFeed()
    {
        $jobs = $this->jobRepository->getAllFeedJobs();
        $rssItems = array_map([$this, 'toRssItem'], $jobs->all());
        $meta = [
            'title' => 'Job Feed',
            'description' => 'Job Feed',
            'link' => route('rssFeed'),
            'copyright' => 'Copyright ' . date('Y') . ' Jobspace',
            'language' => 'en',
            'pubDate' => Carbon::now()->toRfc2822String(),
            'lastBuildDate' => Carbon::now()->toRfc2822String(),
            'ttl' => 60,
            'generator' => 'Laravel',
            'model' => 'item',
        ];
        $view = view('feed.rss', ['rssItems' => $rssItems, 'meta' => $meta]);
        return response($view->render(), 200, ['Content-Type' => 'application/rss+xml']);
    }

    public function toRssItem(Job $job)
    {
        $city_name = $job->city()->first()?->city_name;
        $zone_name = $job->zone()->first()?->zone_name;
        $country_name = $job->country()->first()?->name;
        
        return [
            'title'=> $job->job_title,
            'description'=> $job->job_short_description,
            'job:job_id'=> $job->job_id,
            'job:country'=> $country_name,
            'job:state'=> $zone_name,
            'job:location'=> $city_name,
            'link' => route('jobs.single_id', $job->job_id),
            'guid' => route('jobs.single_id', $job->job_id),
        ];
    }
}
