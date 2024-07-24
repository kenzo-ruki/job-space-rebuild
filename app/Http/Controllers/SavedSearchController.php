<?php

namespace App\Http\Controllers;

use App\Livewire\SaveSearch\SaveSearch;
use Illuminate\Http\Request;
use App\Models\SavedSearch;
use App\Utilities\FlashMessage;

class SavedSearchController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // Add validation rules for other fields
        ]);

        $searchTerms = $request->all();
        if (!empty($searchTerms['keyword'])) {
            $searchTerms['keywords'] = $searchTerms['keyword'];
            unset($searchTerms['keyword']);
        }
        $savedSearch = new SavedSearch($searchTerms);
        $savedSearch->user_id = auth()->id();
        $savedSearch->save();

        FlashMessage::success('Search saved successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from saved searches.
     */
    public function destroy(string $searchId)
    {
        $savedSearch = SavedSearch::query()
            ->where('id', '=', $searchId)
            ->first();
        $savedSearch->delete();
        return redirect('/jobseeker/dashboard#saved-searches');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $savedSearch = SavedSearch::find($id);
        return view('jobseeker.saved-searches.edit', ['savedSearch' => $savedSearch]);
    }
}
