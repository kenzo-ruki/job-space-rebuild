<?php

namespace App\Utilities;

use Illuminate\Support\Str;

class GenerateSlug
{
    public static function generate($record, $modelClass = 'Job'): string
    {
        $baseSlug = Str::slug($record->job_title);
        $slug = $baseSlug;
        $counter = 1;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $record->slug = $slug;
        $record->save();
        return $slug;
    }
}