<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSubCategory extends Model
{
    use HasFactory;

    protected $table = 'job_sub_category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'job_category_id',
        'sub_category_name'
    ];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_job_sub_category');
    }
}
