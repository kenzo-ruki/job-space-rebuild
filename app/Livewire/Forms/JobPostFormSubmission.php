<?php

namespace App\Livewire\Forms;

use Livewire\WithValidation\Attributes\Validate;
use Livewire\WithValidation\Attributes\ValidateEach;
use DateTime;
use Livewire\Form;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\JobImage;
use App\Models\Recruiter;
use Carbon\Carbon;
use App\Utilities\Sanitizer;

class JobPostFormSubmission extends Form
{
    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|string|max:255')]
    public $reference = '';

    #[Validate('required|integer')]
    public $country = 153;

    #[Validate('required|integer')]
    public $zone = 0;

    #[Validate('required|integer')]
    public $city = 0;

    #[Validate('required|integer')]
    public $job_category = 0;

    #[Validate('required|integer')]
    public $job_sub_category = 0;

    #[Validate('required|string')]
    public $start_date = "";

    #[Validate('required|string')]
    public $end_date = "";

    #[Validate('string')]
    public $salary_from = '';

    #[Validate('string')]
    public $salary_to = '';

    #[Validate('required|integer')]
    public $job_type = 1;

    #[Validate('string')]
    public $salary_text = "";

    #[Validate('string')]
    public $job_email = "";

    #[Validate('boolean')]
    public $featured = 0;

    #[Validate('string')]
    public $job_url = '';

    #[Validate('array')]
    #[ValidateEach('image|max:1024')]
    public $images = [];

    #[Validate('string|max:500')]
    public $summary = '';

    #[Validate('required|string|max:5000')]
    public $description = '';

    #[Validate('string')]
    public $video_link = '';

    public $action = 'save';
    public $job = null;
    public $recruiter_id = 0;

    public function rules()
    {
        return [
            'title' =>'required|string',
            'reference' =>'required|string',
            'country' => 'integer',
            'zone' => 'integer',
            'city' => 'integer',
            'job_category' => 'integer',
            'job_sub_category' => 'integer',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'salary_from' => 'string',
            'salary_to' => 'string',
            'salary_text' =>'string',
            'job_email' => 'string',
            'featured' => 'boolean',
            'job_url' =>'string',
            'images' => 'array',
            'summary' =>'required|string|max:500',
            'description' =>'required|string|max:5000',
            'video_link' =>'string',
        ];
    }

    /**
     * Save the form
     */
    public function store()
    {
        $data = $this->getJobData();

        // Get today's date
        $today = new \DateTime();

        // Create DateTime object from end_date
        $end_date = new \DateTime($data['end_date']);

        // Calculate the difference in days
        $interval = $today->diff($end_date)->days;

        // If end_date is more than 30 days from today, set it to today
        if ($interval > 30) {
            $data['end_date'] = $today->format('Y-m-d');
        }

        $this->job = Job::create($data);
        $this->updateRelatedData();
        return $this->job->job_id;
    }

    /**
     * Save the form
     */
    public function update()
    {
        $data = $this->getJobData();
        $this->job->update($data);
        $this->updateRelatedData();
        $this->reset('form');
        $this->resetValidation();
    
        return $this->job->job_id;
    }

    /**
     * Save the form
     */
    public function saveDraft()
    {
        // If a job has already been created and the action is not 'save', don't run this method again
        if ($this->job !== null && $this->action !== 'update') {
            return;
        }
        $data = $this->getJobData();
        $data['re_adv'] = null;
        $data['expired'] = null;

        if ($this->action === 'save' && $this->job === null) {
            $this->job = Job::create($data);
        } else {
            $this->job->update($data);
        }
        $this->updateRelatedData();
        $this->reset('form');
        $this->resetValidation();
    
        return $this->job->job_id;
    }

    private function getJobData()
    {
        $this->validate();

        if (is_array($this->job_type)) {
            $job_type_ids = implode(', ', $this->job_type);
        } else {
            $job_type_ids = $this->job_type;
        }

        $start_date = new DateTime($this->start_date);
        $end_date = new DateTime($this->end_date);
        $interval = $start_date->diff($end_date);
        $job_vacancy_period = $interval->days;

        $this->recruiter_id = Auth::user()->recruiter_id;

        if ($this->description) {
            $this->description = Sanitizer::HTML($this->description);
        }
        return [
            'job_source' => 'jobsite',
            'recruiter_id' => $this->recruiter_id,
            'job_title' => $this->title,
            'job_reference' => $this->reference,
            'job_country_id' => $this->country,
            'job_state_id' => $this->zone,
            'job_city_id' => $this->city,
            'job_type' => $job_type_ids,
            'job_category' => $this->job_category,
            'job_sub_category' => $this->job_sub_category,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'salary_description' => $this->salary_text,
            'job_email_to' => $this->job_email,
            'job_featured' => ($this->featured) ? 'Yes' : 'No',
            'url' => $this->job_url,
            'images' => $this->images,
            'job_short_description' => strip_tags($this->summary),
            'job_description' => $this->description,
            'video_link' => $this->video_link,
            'slug' => Str::slug($this->title),
            're_adv' => $this->start_date,
            'expired' => $this->end_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'job_vacancy_period' => $job_vacancy_period,
        ];
    }

    private function updateRelatedData()
    {
        $this->job->jobCategories()->sync($this->job_category);
        $this->job->jobSubCategories()->sync($this->job_sub_category);

        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                if (method_exists($image, 'store')) {
                    $photo = $image->store('job_images', 'public');
                    JobImage::create([
                        'job_id' => $this->job->job_id,
                        'recruiter_id' => $this->recruiter_id,
                        'image_url' => $photo,
                    ]);
                }
            }
        }
    }
        
}
