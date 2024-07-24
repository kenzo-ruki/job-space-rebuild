<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Utilities\FlashMessage;
use League\OAuth1\Client\Credentials\CredentialsException as CredentialsException;


class OAuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $providerIdName = $provider . '_id';
            $existingUser = User::where('email', $user->email)->first();
    
            if ($existingUser) {
                // Log in existing user
                auth()->login($existingUser);
            } else {
                // Create new user
                $nameParts = explode(' ', $user->name, 2);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : 'User';
                $newUser = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $user->email,
                    $providerIdName => $user->id,
                ]);
                $newUser->assignRole('jobseeker');
                auth()->login($newUser);
            }
            return redirect()->to('/');
        } catch(CredentialsException $e) {
            FlashMessage::error($e->getMessage());
            return redirect()->to('/login');
        }
    }

}