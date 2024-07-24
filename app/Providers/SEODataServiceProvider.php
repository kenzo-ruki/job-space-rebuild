<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use App\Models\Setting;

class SEODataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        SEOManager::SEODataTransformer(function ($SEOData) {

            // Fetch settings from the database
            $settings = Setting::all()->keyBy('key');

            $keys = [
                'twitter_username',
                'title',
                'description',
                'author',
                'image',
                'site_name',
                'favicon',
            ];
            foreach ($keys as $key) {
                if (!$SEOData->$key && isset($settings[$key])) {
                    $SEOData->$key = $settings[$key]->value;
                }
            }
            if (isset($settings['title_suffix'])) {
                $SEOData->title = $SEOData->title . " - " . $settings['title_suffix']->value;
            }
            
            return $SEOData;
        });
    }
}
