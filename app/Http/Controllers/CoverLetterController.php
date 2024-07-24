<?php

namespace App\Http\Controllers;

use App\Models\CoverLetter;
use Illuminate\Http\Request;

class CoverLetterController extends Controller
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
        return view('jobseeker.cover-letter.edit', ['coverLetter' => null]);
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
        $coverLetter = CoverLetter::find($id);
        return view('jobseeker.cover-letter.edit', compact('coverLetter'));
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
    public function destroy(string $id)
    {
        //
        $coverLetter = CoverLetter::find($id);
        $coverLetter->delete();
        return redirect('/jobseeker/dashboard#resumes');
    }
}
