<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'blurb',
        'sort_order',
        'team_photo_path',
    ];

    /**
     * Get the thumbnail for the user.
     *
     * @return string
     */
    public function getThumbnail()
    {
        if (str_starts_with($this->team_photo_path, 'http')) {
            return $this->team_photo_path;
        }

        return '/storage/' . $this->team_photo_path;
    }
}
