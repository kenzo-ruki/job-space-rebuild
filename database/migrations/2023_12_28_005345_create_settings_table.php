<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('label');
            $table->text('value')->nullable();
            $table->json('attributes')->nullable();
            $table->string('type');

            $table->timestamps();
        });

        Setting::create([
            'key' => 'site_name',
            'label' => 'Site Name',
            'value' => 'Website Name',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'sitemap',
            'label' => 'Sitemap',
            'value' => '/path/to/sitemap.xml',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'canonical_link',
            'label' => 'Canonical Link',
            'value' => 1,
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'robots_default',
            'label' => 'Robots Default',
            'value' => 'max-snippet:-1,max-image-preview:large,max-video-preview:-1',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'robots_force_default',
            'label' => 'Robots Force Default',
            'value' => 0,
            'type' => 'boolean',
        ]);
        
        Setting::create([
            'key' => 'favicon',
            'label' => 'Favicon',
            'value' => '/path/to/favicon.ico',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'infer_title_from_url',
            'label' => 'Infer Title From URL',
            'value' => 1,
            'type' => 'boolean',
        ]);
        
        Setting::create([
            'key' => 'title_suffix',
            'label' => 'Title Suffix',
            'value' => 'Appended to every title meta tag',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'homepage_title',
            'label' => 'Homepage Title',
            'value' => 'Homepage Title',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'description',
            'label' => 'Description',
            'value' => 'Website Description',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'image',
            'label' => 'Image',
            'value' => '/path/to/seo_image.png',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'author',
            'label' => 'Author',
            'value' => "Site Author",
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'twitter_username',
            'label' => 'Twitter',
            'value' => '@twitter_tag',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'linkedin',
            'label' => 'LinkedIn',
            'value' => 'LinkedIn Link',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'facebook',
            'label' => 'Facebook',
            'value' => 'Facebook Link',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'instagram',
            'label' => 'Instagram',
            'value' => '@instagram_tag',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'logo',
            'label' => 'Logo',
            'value' => '/path/to/logo.png',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'tagline',
            'label' => 'Tagline',
            'value' => 'Site Tagline',
            'type' => 'text',
        ]);
        
        Setting::create([
            'key' => 'analytics',
            'label' => 'Analytics',
            'value' => 'UA-XXXXXXXXX-X',
            'type' => 'text',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
