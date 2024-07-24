<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $table = 'job_category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_job_category');
    }

    public function subCategories()
    {
        return $this->hasMany(JobSubCategory::class, 'job_category_id');
    }
}