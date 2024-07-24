<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Zone;
use App\Models\Country;
use App\Models\SavedSearch;

class SavedSearchForm extends Component
{
    public function rules()
    {
        return [
            'keywords' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'sub_category' => 'nullable|string',
            'location' => 'nullable|string',
            'sub_location' => 'nullable|string',
            'job_type' => 'nullable|integer',
            'salary_40' => 'nullable|boolean',
            'salary_60' => 'nullable|boolean',
            'salary_80' => 'nullable|boolean',
            'salary_100' => 'nullable|boolean',
        ];
    }

    #[Validate('nullable|string|max:255')]
    public $keywords = '';

    #[Validate('nullable|string')]
    public $category = '';

    #[Validate('nullable|string')]
    public $sub_category = '';

    #[Validate('nullable|string')]
    public $location = '';

    #[Validate('nullable|string')]
    public $sub_location = '';

    #[Validate('nullable|integer')]
    public $job_type = 0;

    #[Validate('nullable|boolean')]
    public $salary_40 = false;

    #[Validate('nullable|boolean')]
    public $salary_60 = false;

    #[Validate('nullable|boolean')]
    public $salary_80 = false;

    #[Validate('nullable|boolean')]
    public $salary_100 = false;

    public $zones = [];
    public $sub_locations = null;
    public $sub_categories = null;
    public $country = 153;
    public $savedSearch = null;
    public $successMessage;

    /**
     * Create a new component instance.
     */
    public function mount(SavedSearch $savedSearch = null)
    {
        /**
         * Initialize the edit form
         */
        if ($savedSearch && $savedSearch?->id) {
            $this->keywords = $savedSearch->keywords;
            $this->category = $savedSearch->category;
            $this->sub_category = $savedSearch->sub_category;
            $this->location = $savedSearch->location;
            $this->sub_location = $savedSearch->sub_location;
            $this->job_type = $savedSearch->job_type;
            $this->salary_40 = $savedSearch->salary_40;
            $this->salary_60 = $savedSearch->salary_60;
            $this->salary_80 = $savedSearch->salary_80;
            $this->salary_100 = $savedSearch->salary_100;
            $this->savedSearch = SavedSearch::find($savedSearch->id);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $this->zones = Zone::where('zone_country_id', $this->country)->get();
        return view('forms.saved-search-form', [
            'job_types' => JobType::all()->toArray(),
            'categories' => JobCategory::all()->toArray(),
            'nz_locations' => Zone::where('zone_country_id', 153)->get()->sortBy('zone_name')->toArray(),
            'au_locations' => Zone::where('zone_country_id', 13)->get()->sortBy('zone_name')->toArray(),
            'sub_categories' => $this->sub_categories,
            'sub_locations' => $this->sub_locations,
        ]);
    }

    public function saveSearch()
    {
        try {
            $this->validate();
            $this->savedSearch->update([
                'keywords' => $this->keywords,
                'category' => $this->category,
                'sub_category' => $this->sub_category,
                'location' => $this->location,
                'sub_location' => $this->sub_location,
                'job_type' => $this->job_type,
                'salary_40' => $this->salary_40,
                'salary_60' => $this->salary_60,
                'salary_80' => $this->salary_80,
                'salary_100' => $this->salary_100,
            ]);
            $this->savedSearch = $this->savedSearch->fresh();
            $this->successMessage = 'Search updated successfully.';
            return;
        } catch (\Exception $e) {
            $this->successMessage = 'There was an error updating this search.';
            return;
        }
    }

    public function countryChanged() 
    {
        $this->zones = Zone::where('zone_country_id', $this->country)->get();
    }

    public function locationChanged()
    {
        $this->zones = Zone::where('zone_country_id', $this->country)->get();
    }

    public function categoryChanged($categorySlug)
    {
        $category = JobCategory::where('slug', $categorySlug)->first();
        $this->sub_categories = $category?->subCategories->toArray();
    }
}
