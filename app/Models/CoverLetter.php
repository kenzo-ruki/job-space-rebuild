<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CoverLetter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'jobseeker_id',
        'title',
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'jobseeker_id', 'jobseeker_id');
    }

    public function excerpt()
    {
        return substr(strip_tags($this->text), 0, 30) . '...';
    }
}
