<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Livewire\Forms\JobPostFormSubmission;
use App\Models\JobCategory;
use App\Models\Zone;
use App\Models\Country;
use App\Models\City;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Utilities\FlashMessage;

class JobPostForm extends Component
{

    use WithFileUploads;

    public JobPostFormSubmission $form;

    public $zones = [];
    public $cities = [];
    public $sub_categories = [];
    public $successMessage;
    public $hideEmail = false;

    /**
     * Create a new component instance.
     */
    public function mount(Job $job = null)
    {

        /**
         * Initialize the edit form
         */
        if ($job && $job?->job_id) {
            $this->form->job = $job;
            $jobArray = $job->toArray();
            $jobCategoryId = '';
            if (isset($jobArray['job_categories']) && is_array($jobArray['job_categories']) && !empty($jobArray['job_categories'])) {
                $jobCategoryId = array_column($jobArray['job_categories'], 'id')[0];
            }
            $imageArray = $jobArray['images'];
            $this->categoryChanged($jobCategoryId);
            $jobSubCategoryIds = array_column($jobArray['job_sub_categories'], 'id');
            $this->form->title = $job->job_title;
            $this->form->reference = $job->job_reference;
            $this->form->country = $job->job_country_id;
            $this->form->zone = $job->job_state_id;
            $this->form->city = $job->job_city_id;
            $this->form->job_type = $job->job_type;
            $this->form->job_category = $jobCategoryId;
            $this->form->job_sub_category = $jobSubCategoryIds[0] ?? 0;
            $this->form->start_date = (new \DateTime($job->re_adv))->format('Y-m-d');
            $this->form->end_date = (new \DateTime($job->expired))->format('Y-m-d');
            $this->form->salary_from = $job->salary_from;
            $this->form->salary_to = $job->salary_to;
            $this->form->salary_text = $job->salary_description;
            $this->form->job_email = $job->job_email_to;
            $this->form->featured = ($job->job_featured == 'Yes') ? 1 : 0;
            $this->form->job_url = $job->url;
            $this->form->images = array_map(fn($image) => $image['image_url'], $imageArray);
            $this->form->summary = $job->job_short_description;
            $this->form->description = $job->job_description;
            $this->form->action = 'update';
            if(!empty($this->form->job->re_adv)) {
                $this->form->start_date = (new \DateTime())->format('Y-m-d');
            }
        } else {
            $this->form->job_email = Auth::user()->email;
            $this->form->start_date = (new \DateTime())->format('Y-m-d');
            do {
                $reference = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
            } while (Job::where('job_reference', $reference)->exists());
            $this->form->reference = $reference;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
        return view('forms.job-post-form', [
            'job_types' => JobType::all()->toArray(),
            'categories' => JobCategory::all()->toArray(),
            'sub_categories' => $this->sub_categories,
            'countries' => Country::all()->sortBy('name')->toArray(),
            'zones' => $this->zones,
        ]);
    }

    /**
     * Save the form
     */
    public function save()
    {
        try {
            $job_id = $this->form->store();
            return redirect()->to("/job/$job_id/edit");
        } catch (\Exception $e) {
            FlashMessage::error('There was an error creating this job.' . $e->getMessage());
        }
    }

    /**
     * Update the form
     */
    public function update()
    {
        try {
            $job_id = $this->form->update();
            FlashMessage::success('Job updated successfully!');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this job.' . $e->getMessage());
            return;
        }
    }

    /**
     * Save as a draft.
     */
    public function saveDraft()
    {
        try {
            $job_id = $this->form->saveDraft();
            return redirect()->to("/job/$job_id/edit");
            FlashMessage::success('Draft job updated successfully!');
            return;
        } catch (\Exception $e) {
            FlashMessage::error('There was an error updating this job.' . $e->getMessage());
            return;
        }
    }

    public function countryChanged() 
    {
        $this->zones = Zone::where('zone_country_id', $this->form->country)->get();
    }

    public function categoryChanged($categoryId)
    {
        $category = JobCategory::where('id', $categoryId)->first();
        $this->sub_categories = $category?->subCategories->toArray();
    }

    public function zoneChanged($zoneId)
    {
        $this->cities = City::where('city_zone_id', $zoneId)->get();
    }

    public function toggleEmailVisibility()
    {
        $this->hideEmail = !empty($this->form->job_url);
    }
}
