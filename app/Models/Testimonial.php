<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'company',
        'position',
        'testimonial',
        'company_photo_path',
    ];

    /**
     * Get the thumbnail for the user.
     *
     * @return string
     */
    public function getThumbnail()
    {
        if (str_starts_with($this->company_photo_path, 'http')) {
            return $this->company_photo_path;
        }

        return '/storage/' . $this->company_photo_path;
    }
}
