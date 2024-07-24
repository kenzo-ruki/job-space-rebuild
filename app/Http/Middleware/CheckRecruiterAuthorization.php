<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRecruiterAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $model, $method)
    {
        $modelInstance = $request->route($model);

        // Get the recruiter instance associated with the authenticated user
        if ($user && $user->$method($modelInstance)) {
            // Check if the user has a recruiter_id and if the recruiter has a company
            if ($user->recruiter_id) {
                return $next($request);
            } else {
                // Redirect to 'recruiter.dashboard' with the #company if the recruiter doesn't have a company
                return redirect()->route('recruiter.dashboard', ['#company-profile']);
            }
        }
    
        // Redirect or throw an exception if the user is not authorized
        return redirect('/');
    }
}
