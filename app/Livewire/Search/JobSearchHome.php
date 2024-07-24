<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\Zone;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class JobSearchHome extends Component
{
    public $keywords = null;
    public $job_type = null;
    public $category = null;
    public $sub_category = null;
    public $sub_categories = null;
    public $location = null;
    public $location_name = null;
    public $sub_location = null;
    public $sub_locations = null;
    public $salary_40 = false;
    public $salary_60 = false;
    public $salary_80 = false;
    public $salary_100 = false;
    public $isset = false;
    public $errors = [];

    protected $rules = [
        'keywords' => 'nullable|string|max:255',
        'job_type' => 'nullable|exists:job_type,id',
        'category' => 'nullable|exists:job_category,slug',
        'sub_category' => 'nullable|exists:job_sub_category,slug',
        'sub_categories' => 'nullable',
        'location' => 'nullable|string|max:255',
        'sub_locations' => 'nullable',
        'sub_location' => 'nullable|string|max:255',
        'salary_40' => 'nullable|boolean',
        'salary_60' => 'nullable|boolean',
        'salary_80' => 'nullable|boolean',
        'salary_100' => 'nullable|boolean',
    ];

    public function mount()
    {
        //'category', 'sub_category', 'keywords', 'location', 'sub_location', 'job_type'
        $search_form_data = Session::get('search_form_data', []);
        if (!empty($search_form_data['category'])) {
            $this->categoryChanged($search_form_data['category']);
            $this->isset = true;
        }
        if (!empty($search_form_data['sub_location'])) {
            $this->subLocationChanged($search_form_data['sub_location']);
            $this->isset = true;
        } else if (!empty($search_form_data['location'])) {
            $this->locationChanged($search_form_data['location']);
            $this->isset = true;
        }
        $this->fill($search_form_data);
    }

    public function search()
    {
        $validatedData = [];
        try {
            $validatedData = $this->validate();
            $this->isset = true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->errors = collect($e->validator->errors()->messages())->flatten();
            Log::error($this->errors);
            return;
        }

        // Store the validated data in the session for the next request
        if (!empty($validatedData['sub_location'])) {
            $validatedData['location'] = $validatedData['sub_location'];
        }
        Session::put('search_form_data', $validatedData);

        // Determine the redirect URL based on the form fields that are submitted
        $redirectUrl = '/jobs'; // Default redirect URL
        if (!empty($validatedData['category'])
            && !empty($validatedData['sub_category'])
            && !empty($validatedData['location'])) {
            $redirectUrl = route(
                'jobs.sub_category_location',  [
                'category' => $validatedData['category'],
                'sub_category' => $validatedData['sub_category'],
                'location' => $validatedData['location'],
            ]);
        } elseif (!empty($validatedData['category'])
            && !empty($validatedData['sub_category'])) {
            $redirectUrl = route(
                'jobs.sub_category',  [
                'category' => $validatedData['category'],
                'sub_category' => $validatedData['sub_category'],
            ]);
        } elseif (!empty($validatedData['category'])
            && !empty($validatedData['location'])) {
            $redirectUrl = route(
                'jobs.category_location',  [
                'category' => $validatedData['category'],
                'location' => $validatedData['location'],
            ]);
        } elseif (!empty($validatedData['category'])) {
            $redirectUrl = route(
                'jobs.category',  [
                'category' => $validatedData['category'],
            ]);
        } elseif (!empty($validatedData['location'])) {
            $redirectUrl = route(
                'jobs.location',  [
                'location' => $validatedData['location'],
            ]);
        } elseif (!empty($validatedData['keywords'])) {
            $redirectUrl = route(
                'jobs.keywords',  [
                'keywords' => $validatedData['keywords'],
            ]);
        }
        return redirect($redirectUrl)->with($validatedData);
    }

    public function categoryChanged($categorySlug)
    {
        $category = JobCategory::where('slug', $categorySlug)->first();
        $this->sub_categories = $category?->subCategories->toArray();
    }


    public function subLocationChanged($locationSlug)
    {
        $location = City::where('slug', $locationSlug)->first();
        if ($location === null) {
            Session::put('search_form_data.sub_location', null);
            return;
        }
        $this->location = $location?->slug;
        $this->location_name = $location?->city_name;
        Session::put('search_form_data.location_name', $this->location_name);
        $this->sub_locations = City::where('city_zone_id', $location?->city_zone_id)
            ->where('city_id', '!=', $location?->city_id)
            ->get()
            ->toArray();
    }

    public function locationChanged($locationSlug)
    {
        $location = Zone::where('slug', $locationSlug)->first();
        if ($location === null) {
            Session::put('search_form_data.location', null);
            return;
        }
        $this->location = $location?->slug;
        $this->location_name = $location?->zone_name;
        Session::put('search_form_data.location_name', $this->location_name);
        $this->sub_locations = City::where('city_zone_id', $location?->zone_id)->get()->toArray();
    }

    public function loadAllLocations()
    {
        $this->location = null;
        $this->location_name = null;
        $this->sub_location = null;
        $this->sub_locations = null;
        Session::put('search_form_data.location', null);
        Session::put('search_form_data.location_name', null);
        Session::put('search_form_data.sub_location ', null);
        Session::put('search_form_data.sub_locations', null);
    }

    public function render()
    {
        return view('livewire.search.job-search-home', [
            'job_types' => JobType::all()->toArray(),
            'categories' => JobCategory::all()->toArray(),
            'nz_locations' => Zone::where('zone_country_id', 153)->get()->sortBy('zone_name')->toArray(),
            'au_locations' => Zone::where('zone_country_id', 13)->get()->sortBy('zone_name')->toArray(),
            'sub_categories' => $this->sub_categories,
            'sub_locations' => $this->sub_locations,
        ]);
    }

    public function resetSearch()
    {
        $this->keywords = null;
        $this->job_type = null;
        $this->category = null;
        $this->sub_category = null;
        $this->sub_categories = null;
        $this->location = null;
        $this->location_name = null;
        $this->sub_location = null;
        $this->sub_locations = null;
        $this->salary_40 = false;
        $this->salary_60 = false;
        $this->salary_80 = false;
        $this->salary_100 = false;
        $this->isset = false;
        session()->forget('search_form_data');
        redirect()->intended('/');
    }
}
