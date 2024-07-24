<?php

namespace App\Providers;

use Illuminate\Hashing\HashServiceProvider;
use App\Services\TransitionalHasher;

class TransitionalHashProvider extends HashServiceProvider {

    public function boot()
    {
        \App::bind('hash', function () {
            return new TransitionalHasher;
        });

        parent::boot();
    }

}