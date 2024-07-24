<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifySubmission extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
        'frequency',
        'category',
        'occupation',
        'location',
    ];
}
