<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{

    /**
     * Remove the specified resource from saved jobs.
     */
    public function destroy(string $jobId)
    {
        $user = Auth::user();
        $savedJob = SavedJob::query()
            ->where('job_id', '=', $jobId)
            ->where('jobseeker_id', '=', $user->jobseeker_id)
            ->first();
        $savedJob->delete();
        // Store the saved jobs in the session
        session(['saved_jobs' => SavedJob::where('jobseeker_id', $user->jobseeker_id)->get()]);
        return redirect('/jobseeker/dashboard/#saved-jobs');
    }
}
