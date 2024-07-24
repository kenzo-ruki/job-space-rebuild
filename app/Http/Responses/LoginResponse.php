<?php
 
namespace App\Http\Responses;
 
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * @param $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = '/';

        if (Auth::user()->hasRole('admin')) {
            $home = '/admin';
        } else if (Auth::user()->hasRole('recruiter')) {
            $home = '/recruiter/dashboard';
        } else if (Auth::user()->hasRole('jobseeker')) {
            $home = '/jobseeker/dashboard';
        } else if (Auth::user()->hasRole('user')) {
            $home = '/dashboard';
        }
 
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended($home);
    }
}
