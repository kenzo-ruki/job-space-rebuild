<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckResumeAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $model, $method)
    {
        $modelInstance = $request->route($model);

        // Get the authenticated user
        $user = auth()->user();
        // Get the recruiter instance associated with the authenticated user
        $recruiter = auth()->user()?->recruiter;
    
        if ($recruiter && $recruiter->$method($modelInstance)) {
            return $next($request);
        } else if ($user && $user->$method($modelInstance)) {
            return $next($request);
        }
    
        // Redirect or throw an exception if the user is not authorized
        return redirect('/');
    }
}
