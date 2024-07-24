<?php

namespace App\Livewire\Forms;

use App\Filament\Admin\Widgets\Job;
use Livewire\Component;
use App\Models\JobAlert;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Zone;
use App\Models\Country;
use App\Repositories\JobRepository;
use App\Utilities\FlashMessage;

class JobAlertForm extends Component
{

    #[Validate('email')]
    public $email = '';

    #[Validate('required|string')]
    public $title = '';

    #[Validate('nullable|string')]
    public $keywords = '';

    #[Validate('nullable|string')]
    public $location = '';

    #[Validate('nullable|integer')]
    public $country = 153;

    #[Validate('nullable|integer')]  
    public $zone = 0;

    #[Validate('nullable|string')]
    public $job_category = 0;

    #[Validate('nullable|integer')]
    public $job_type = '';

    #[Validate('nullable|integer')]
    public $job_salary = '';

    #[Validate('nullable|string')]
    public $recruiter_id = '';

    #[Validate('required|string')]
    public $frequency = '';


    public $zones = [];
    public $sub_locations = null;
    public $savedSearch = null;
    public $jobseeker_id = null;
    public $successMessage;

    public JobAlert $jobAlert;
    private $jobRepository;

    public function __construct()
    {
        $this->jobRepository = new JobRepository;
    }

    public function rules()
    {
        return [
            'email' => 'nullable|email',
            'title' => 'required|string',
            'keywords' => 'nullable|string',
            'location' => 'nullable|string',
            'job_category' => 'nullable|string',
            'job_type' => 'nullable|integer',
            'job_salary' => 'nullable|integer',
            'recruiter_id' => 'nullable|string',
            'frequency' => 'required|string',
        ];
    }

    public function mount(JobAlert $jobAlert = null) 
    {
        $searchFormData = session('search_form_data', false);
        if ($jobAlert && $jobAlert->id) {
            $this->email = $jobAlert->email;
            $this->jobseeker_id = $jobAlert->jobseeker_id;
            $this->title = $jobAlert->title;
            $this->keywords = $jobAlert->keywords;
            $this->country = $jobAlert->country;
            $this->zone = $jobAlert->zone;
            $this->job_category = $jobAlert->job_category;
            $this->job_type = $jobAlert->job_type;
            $this->job_salary = $jobAlert->job_salary;
            $this->recruiter_id = $jobAlert->recruiter_id;
            $this->frequency = $jobAlert->frequency;
            if ($jobAlert->zone) {
                $zone = Zone::find($jobAlert->zone);
                $this->location = $zone?->slug;
            } else if ($jobAlert->country) {
                $country = Country::find($jobAlert->country);
                $this->location = $country?->slug;
            }
            $this->jobAlert = $jobAlert;
        } else if ($searchFormData) {
            $this->keywords = isset($searchFormData['keywords']) ? $searchFormData['keywords'] : null;
            $this->job_category = isset($searchFormData['category']) ? $searchFormData['category'] : null;
            $this->job_type = isset($searchFormData['job_type']) ? $searchFormData['job_type'] : null;
            $this->location = isset($searchFormData['location']) ? $searchFormData['location'] : null;
        }
    }

    public function createJobAlert()
    {
        try {
            $this->validate();
            $user = auth()->user();
            $this->jobseeker_id = $user?->jobseeker_id;
            if (!$this->email && !$this->jobseeker_id) {
                FlashMessage::error('Please include a valid email address.');
                return;
            }
            
            [$keyString, $key] = $this->jobRepository->getLocation($this->location);
            if ($keyString == 'id') {
                $country = Country::find($key);
                $this->country = $country?->id;
            } else if ($keyString == 'job_state_id') {
                $zone = Zone::find($key);
                $this->zone = $zone?->zone_id;
            }

            $this->jobAlert = new JobAlert([
                "email" => $this->email,
                "jobseeker_id" => $this->jobseeker_id,
                "title" => $this->title,
                "keywords" => $this->keywords,
                "country" => $this->country,
                "zone" => $this->zone,
                "job_category" => $this->job_category,
                "job_type" => $this->job_type,
                "job_salary" => $this->job_salary,
                "recruiter_id" => $this->recruiter_id,
                "frequency" => $this->frequency,
            ]);
            $save = $this->jobAlert->save();
            FlashMessage::success('Alert created successfully.');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error creating this alert.');
            return;
        }
    }

    public function updateJobAlert()
    {
        try {
            $this->validate();
            $user = auth()->user();
            $this->jobseeker_id = $user?->jobseeker_id;
            if (!$this->email && !$this->jobseeker_id) {
                FlashMessage::error('Please include a valid email address.');
                return;
            }
            
            [$keyString, $key] = $this->jobRepository->getLocation($this->location);
            if ($keyString == 'id') {
                $country = Country::find($key);
                $this->country = $country?->id;
            } else if ($keyString == 'job_state_id') {
                $zone = Zone::find($key);
                $this->zone = $zone?->zone_id;
            }

            $this->jobAlert->update([
                "email" => $this->email,
                "jobseeker_id" => $this->jobseeker_id,
                "title" => $this->title,
                "keywords" => $this->keywords,
                "country" => $this->country,
                "zone" => $this->zone,
                "job_category" => $this->job_category,
                "job_type" => $this->job_type,
                "job_salary" => $this->job_salary,
                "recruiter_id" => $this->recruiter_id,
                "frequency" => $this->frequency,
            ]);
            $this->jobAlert->save();
            FlashMessage::success('Alert updated successfully.');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this alert.');
            return;
        }
    }

    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->country)->get();
        return view('forms.job-alert-form', [
            'job_types' => JobType::all()->toArray(),
            'categories' => JobCategory::all()->toArray(),
            'nz_locations' => Zone::where('zone_country_id', 153)->get()->sortBy('zone_name')->toArray(),
            'au_locations' => Zone::where('zone_country_id', 13)->get()->sortBy('zone_name')->toArray(),
            'sub_locations' => $this->sub_locations,
        ]);
    }

}