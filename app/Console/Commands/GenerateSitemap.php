<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page;
use App\Models\Post;
use App\Models\Job;
use App\Utilities\GenerateSlug;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'app:sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Add home page to the sitemap
        $sitemap->add(Url::create(config('app.url')));

        // Add pages to the sitemap
        $pages = Page::all();
        $modelClass = \App\Models\Page::class;

        foreach ($pages as $page) {
            if ($page->active) {
                if (empty($page->slug)) {
                    GenerateSlug::generate($page, $modelClass);
                }
                if ($page->slug && 'home'!= $page->slug) {
                    $sitemap->add(Url::create('/'.$page->slug));
                }
            }
        }
    
        // Add posts to the sitemap
        $posts = Post::all();
        $modelClass = \App\Models\Post::class;
        foreach ($posts as $post) {
            if ($post->active) {
                if (empty($post->slug)) {
                    GenerateSlug::generate($post, $modelClass);
                }
                if ($post->slug) {
                    $sitemap->add(Url::create('/blog/'.$post->slug));
                }
            }
        }

        // Add jobs to the sitemap
        $jobs = Job::with('jobCategories')
            ->whereDate('created_at', '<=', Carbon::now())
            ->whereDate('expired', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();
        $modelClass = \App\Models\Job::class;
        foreach ($jobs as $job) {
            if ($job->jobCategories->contains('id', 77)) {
                continue;
            }
            if (empty($job->slug)) {
                GenerateSlug::generate($job, $modelClass);
            }
            if ($job->slug) {
                $sitemap->add(Url::create('/jobs/'.$job->job_id.'/'.$job->slug));
            }
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
