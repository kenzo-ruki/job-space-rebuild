<?php

function tep_validate_password($plain, $encrypted)
{
    if (!is_null($plain) && !is_null($encrypted)) {
        // split apart the hash / salt
        $stack = explode(':', $encrypted);
        if (sizeof($stack) != 2)
            return false;
        if (md5($stack[1] . $plain) == $stack[0]) {
            return true;
        }
    }
    return false;
}
/*
me@peterthomson.co.nz
user48325@email.com
&V5U31vX-'f`
vicol59690@dovesilo.com
vicol59690
dasbootface1@gmail.com
user6282@email.com
Peter123$
Peter
HcZQKHFf
dasbootface+1@gmail.com
dasbootface+1
*/
namespace BadmintonBible\Core\Extensions;

use BadmintonBible\Users\Models\User;

class TransitionalHasher extends \Illuminate\Hashing\BcryptHasher {

    public function check($value, $hashedValue, array $options = array())
    {
        // If check fails, is it an old MD5 hash?
        if ( !password_verify($value, $hashedValue) )
        {
            $user = User::wherePassword( md5($value) )->first();

            if ($user)  // We found a user with a matching MD5 hash
            {
                // Update the password to Laravel's Bcrypt hash
                // If two users have matching passwords, we might update the
                // wrong user -- but it doesn't matter!
                $user->password = \Hash::make($value);
                $user->save();

                // Log in the user
                return true;
            }
        }

        return password_verify($value, $hashedValue);
    }

}

namespace BadmintonBible\Core\Extensions;

class TransitionalHashProvider extends \Illuminate\Hashing\HashServiceProvider {

    public function boot()
    {
        \App::bind('hash', function()
        {
            return new TransitionalHasher;
        });

        parent::boot();
    }

}