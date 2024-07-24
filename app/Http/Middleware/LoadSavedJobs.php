<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class LoadSavedJobs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->hasRole('jobseeker')) {
            $user = Auth::user();
            $savedJobs = SavedJob::where('jobseeker_id', $user->jobseeker_id)->get();
            session(['saved_jobs' => $savedJobs]);
        }

        return $next($request);
    }
}
