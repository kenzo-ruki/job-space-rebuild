<?php

namespace App\Http\Controllers;

use App\Models\JobAlert;
use Illuminate\Http\Request;

class JobAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jobseeker.job-alerts.edit', ['jobAlert' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jobAlert = JobAlert::find($id);
        return view('jobseeker.job-alerts.edit', compact('jobAlert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobAlert $jobAlert)
    {
        //
        $jobAlert->delete();
        return redirect('/jobseeker/dashboard#job-alerts');
    }
}
