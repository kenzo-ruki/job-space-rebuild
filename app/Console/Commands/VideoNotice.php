<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\VideoReminder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class VideoNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:video-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify new Jobseekers of video creation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $startDate = Carbon::now()->subDays(4);
        $endDate = Carbon::now()->subDays(3);
        $users = User::where('video_path', null)
                     ->whereBetween('jobseeker_id', [$startDate, $endDate])
                     ->get();
    
        foreach ($users as $user) {
            $this->info('Notifying new Jobseeker video notice for user: ' . $user->id);
            Mail::to('seth@jobspace.co.nz')
                ->send(new VideoReminder($user));
        }
    
        $this->info('Notification completed.');
    }
}
