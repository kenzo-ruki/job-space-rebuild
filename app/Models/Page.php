<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Models\SEO;

class Page extends Model
{
    use HasSEO;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'url',
        'thumbnail',
        'body',
        'active',
        'layout',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function shortBody($words = 30): string
    {
        return Str::words(strip_tags($this->body), $words);
    }

    public function getFormattedDate()
    {
        return $this->published_at->format('F jS Y');
    }

    public function getThumbnail()
    {
        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return '/storage/' . $this->thumbnail;
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function ($value, $attributes) {
                $words = Str::wordCount(strip_tags($attributes['body']));
                $minutes = ceil($words / 200);

                return $minutes . ' ' . str('min')->plural($minutes) . ', '
                    . $words . ' ' . str('word')->plural($words);
            }
        );
    }
}
