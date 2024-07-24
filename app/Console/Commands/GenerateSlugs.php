<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utilities\GenerateSlug;

class GenerateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $models = [
            // \App\Models\Zone::class,
            // \App\Models\City::class,
            // \App\Models\Country::class,
            // \App\Models\JobCategory::class,
            // \App\Models\JobSubCategory::class,
            \App\Models\Job::class,
        ];
    
        foreach ($models as $modelClass) {
            $modelClass::whereNull('slug')->chunk(500, function ($records) use ($modelClass) {
                foreach ($records as $record) {
                    $slug = GenerateSlug::generate($record, $modelClass);
                }
            });
        }
    
        $this->info('Slugs generated successfully.');
    }
}
