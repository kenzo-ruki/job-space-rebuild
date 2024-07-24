<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use Illuminate\View\View;

class RateController extends Controller
{
    //    
    public function index(): View
    {
        // All rates
        $rates = Rate::all();

        $singleRates = Rate::where('number_of_postable_jobs', 1)
                        ->orderBy('fee', 'desc')
                        ->get();
        $annualRates = Rate::where('number_of_postable_jobs', '>', 1000)
                        ->orderBy('fee', 'desc')
                        ->get();
        $packRates = Rate::where('number_of_postable_jobs', '>', 1)
                        ->where('number_of_postable_jobs', '<', 1000)
                        ->orderBy('fee', 'desc')
                        ->get();
        return view('rates', compact('singleRates', 'annualRates', 'packRates'));
    }

    /**
     * Display the specified resource.
     */
    public function single(Rate $rate, Request $request)
    {
        return view('rate', compact('rate'));
    }
}
