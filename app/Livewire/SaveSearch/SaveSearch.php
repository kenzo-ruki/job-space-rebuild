<?php

namespace App\Livewire\SaveSearch;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\SavedSearch;
use App\Repositories\JobRepository;
use App\Models\JobCategory;
use App\Models\City;
use App\Models\Zone;
use App\Utilities\FlashMessage;

class SaveSearch extends Component
{

    public function save(JobRepository $jobRepository)
    {
        
        $search = Session::get('search_form_data');
        $titleParts = [];
        if (!empty($search['category'])) {
            $category = JobCategory::find($search['category']);
            $titleParts[] = $search['category'];
        }

        if (!empty($search['keyword'])) {
            $search['keywords'] = $search['keyword'];
            unset($search['keyword']);
        }

        if (!empty($search['date'])) {
            $titleParts[] = $search['date'];
        }

        $titleParts[] = date('F j, Y');
        $search['title'] = implode(' - ', $titleParts);
        $savedSearch = new SavedSearch($search);

        // Get the location data
        if (!empty($search['location'])) {
            [$keyString, $key] = $jobRepository->getLocation($search['location']);
            if ($keyString == 'job_city_id') {
                $city = City::find($key);
                $savedSearch->locationable()->associate($city);
            } else if ($keyString == 'job_state_id') {
                $state = Zone::find($key);
                $savedSearch->locationable()->associate($state);
            }
        }
        $savedSearch->user_id = Auth::id();
        $savedSearch->save();

        $searchEditLink = "/saved-searches/{$savedSearch->id}/edit";
        FlashMessage::raw("Your search has been saved. You can edit it <a class=\"text-cerise-red-500\" href=\"{$searchEditLink}\"> here</a>.");
    }

    public function render()
    {
        return view('livewire.save-search.save-search');
    }
}
