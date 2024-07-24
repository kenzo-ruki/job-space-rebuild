<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;
use App\Models\User;

class TransitionalHasher extends BcryptHasher
{

    public function check($value, $hashedValue, array $options = [])
    {
        if (!password_verify($value, $hashedValue)) {
            // If check fails, is it an old MD5 hash?
            $user = User::where('password', $hashedValue)->first();
            if ($user && $this->legacy_validate_password($value, $user->password)) {
                // Update the password to Laravel's Bcrypt hash
                $user->password = Hash::make($value);
                $user->save();
                Auth::login($user);
                if ($user->hasRole('admin')) {
                    return redirect()->to(route('admin'));
                } else if ($user->hasRole('recruiter')) {
                    return redirect()->to(route('recruiter.dashboard'));
                } else if ($user->hasRole('jobseeker')) {
                    return redirect()->to(route('jobseeker.dashboard'));
                }
                return redirect()->to(route('home'));
            }
        }

        return password_verify($value, $hashedValue);
    }

    private function legacy_validate_password($plain, $encrypted)
    {
        // split apart the hash / salt
        $stack = explode(':', $encrypted);

        if (count($stack) != 2) {
            return false;
        }
        if (md5($stack[1] . $plain) == $stack[0]) {
            return true;
        }
        return false;
    }
}
