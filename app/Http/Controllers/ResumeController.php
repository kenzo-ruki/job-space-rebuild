<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Application;
use App\Models\CoverLetter;
use App\Models\User;
use App\Models\ResumeInteraction;
use App\Utilities\RecruiterCredits;
use Symfony\Component\HttpFoundation\File\File;

class ResumeController extends Controller
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
        return view('jobseeker.resume.create');
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
    public function show(Resume $resume)
    {
        // Get the authenticated user
        $user = auth()->user();
        // Get the recruiter instance associated with the authenticated user
        $recruiter = auth()->user()?->recruiter;
        if ($recruiter) {
            return view('recruiter.resume.view', ['resume' => $resume]);
        } else {
            $user = auth()->user();
            if ($resume->jobseeker_id == $user->jobseeker_id) {
                $resumes = Resume::where('jobseeker_id', '=', $user->jobseeker_id)->get();
                $coverLetters = CoverLetter::where('jobseeker_id', $user->jobseeker_id);
                return view('jobseeker.resume.show', compact('resume', 'resumes', 'coverLetters'));
            } else {
                abort(401);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = auth()->user();
        $coverLetters = CoverLetter::where('jobseeker_id', $user->jobseeker_id);
        $resume = Resume::find($id);
        return view('jobseeker.resume.edit', compact('coverLetters', 'resume'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Display resume search results.
     */
    public function search(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            'keywords' => 'nullable|string',
            'job_type' => 'nullable|integer',
            'country' => 'nullable|integer',
            'job_category' => 'nullable|integer',
            'zone' => 'nullable|integer',
        ]);

        // Sanitize
        $keywords = (string) $validatedData['keywords'];
        $country = (int) $validatedData['country'];
        $jobCategory = (int) $validatedData['job_category'];
        $zone = (int) $validatedData['zone'];
        $job_type = (int) $validatedData['job_type'];

        $results = Resume::with('user');

        if (!empty($keywords)) {
            $results = $results->where(function ($query) use ($keywords) {
                return $query->where(function ($query) use ($keywords) {
                    $query->where('resume_text', 'like', "%{$keywords}%")
                          ->orWhere('title', 'like', "%{$keywords}%");
                });
            });
        }

        if (!empty($job_type)) {
            $results = $results->whereRaw('FIND_IN_SET(?, job_type_id)', [$job_type]);
        }

        if (!empty($country)) {
            $results = $results->where('country', $country);
        }

        if (!empty($jobCategory)) {
            $results = $results->whereRaw('FIND_IN_SET(?, job_category)', [$jobCategory]);
        }

        if (!empty($zone)) {
            $results = $results->where('region', $zone);
        }

        $resumes = $results->paginate(10)->appends([
            'job_type' => $job_type,
            'keywords' => $keywords,
            'country' => $country,
            'job_category' => $jobCategory,
            'zone' => $zone,
        ]);

        return view('recruiter.resume-search.search', ['resumes' => $resumes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $resumeId)
    {
        //
        $resume = Resume::query()
            ->where('id', '=', $resumeId)
            ->first();
        $resume->delete();
        return redirect('/jobseeker/dashboard#resumes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function download(Resume $resume, Application $application = null)
    {
        $user = auth()->user();
        $redirect = false;
        if ($user->recruiter_id) {
            $cvCredits = RecruiterCredits::getCVCredits();
            if (!$cvCredits && $application == null) {
                $redirect = redirect('/recruiter/dashboard');
            } else if ($cvCredits && $application == null) {
                $recruiter = auth()->user()->recruiter;
                $cookieName = 'jobspace_' . $recruiter->recruiter_id . '_paid_cvs';
                $paidCVs = isset($_COOKIE[$cookieName]) ? json_decode($_COOKIE[$cookieName], true) : [];
                if (!in_array($resume->id, $paidCVs)) {
                    array_push($paidCVs, $resume->id);
                    setcookie($cookieName, json_encode($paidCVs), time() + (86400 * 365), "/");
                    RecruiterCredits::deductCVCredit();
                }
            }
        } else if ($user->jobseeker_id && ($user->jobseeker_id !== $resume->jobseeker_id)) {
            $redirect = redirect('/jobseeker/dashboard');
        }

        if ($redirect) {
            return $redirect;
        }

        // Define the file path
        $filename = $resume->resume;
        $folder = substr($filename, 0, 6); // Extracts the first 6 characters
        $filePath = storage_path(join(DIRECTORY_SEPARATOR, ['app', 'public', 'resumes', $folder, $filename]));
        // Create a new File instance
        $file = new File($filePath);
        // Guess the mime type
        $mimeType = $file->getMimeType();
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$resume->resume.'"',
        ];
        return response()->download($filePath, null, $headers);
    }

    /**
     * Create a single application.
     */
    public function contact(Resume $resume)
    {
        //
        $jobseeker = User::where('jobseeker_id', '=', $resume->jobseeker_id)->get()->first();
        $message = ResumeInteraction::where('resume_id', '=', $resume->id)->get()->last();
        return view('recruiter.messages.contact', ['message' => $message, 'resume' => $resume, 'jobseeker' => $jobseeker]);
    }
}
