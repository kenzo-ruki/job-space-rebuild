@php
use App\Utilities\RecruiterCredits;

$jobCredits = RecruiterCredits::getJobCredits();
$createJobLink = route('rates');
$createJobText = 'Sign Up For Jobs';
if ($jobCredits) {
    $createJobLink = route('job.create');
    $createJobText = 'Post a Job';
}
$cvCredits = RecruiterCredits::getCVCredits();
$cvSearchText = 'Sign Up For CVs';
if ($cvCredits) {
    $cvSearchText = 'Resumes';
}
$user = auth()->user();
$noRecruiter = $user->recruiter_id ? false : true;
@endphp
<x-app-layout>
    @if ($noRecruiter)
    @include('partials.recruiter-banner')
    @endif
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">

        @if(session()->has('message'))
            @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
        @endif
        @if(null === $recruiter)
            @include('messages.message', ['message' => 'Please update your Company Profile'])
        @endif

        @include('recruiter.stats',  [
            'currentjobs' => $currentJobs,
            'createJobLink' => $createJobLink,
            'createJobText' => $createJobText,
            'totalViews' => $totalViews,
            'jobCredits' => $jobCredits,
            'cvCredits' => $cvCredits
        ])

        <div id="dashboard">
            @include('recruiter.dashboard-menu', ['dashboard' => true])
            <div id="job-post" role="tabpanel" aria-labelledby="job-post-label" class="tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">{{ $createJobText }} </h2>
                @include('recruiter.job-post.create')
            </div>
            <div id="resume-search" role="tabpanel" aria-labelledby="resume-search-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">Resume/CV Search</h2>
                @include('recruiter.resume-search.card')
            </div>
            <div id="current-jobs" role="tabpanel" aria-labelledby="current-jobs-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">My Jobs</h2>
                @include('recruiter.current-jobs.index')
            </div>
            <div id="users" role="tabpanel" aria-labelledby="users-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <div class="relative mb-12">
                    <h2 class="text-4xl font-thin text-slate-900">Users</h2>
                    @include('recruiter.users.create')
                    @include('recruiter.users.index')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
