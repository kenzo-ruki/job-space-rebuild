<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJobseekerAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user) {
            // Check if the user has a resume
            if ($user->hasResume()) {
                return $next($request);
            } else {
                // Check if the current route is 'resume.create' to prevent a redirect loop
                if ($request->route()->getName() !== 'resume.create') {
                    return redirect()->route('resume.create');
                }
            }
        }
        return $next($request);
    }
}
