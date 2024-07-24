<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\JobsImport;

class ImportJobadderJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import jobs from XML files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info('Starting import...');
        $jobsImport = new JobsImport();
        $jobsImport->importFromDirectory(base_path('jobadder'), $this);
        $this->info('Import completed.');
    }
}
