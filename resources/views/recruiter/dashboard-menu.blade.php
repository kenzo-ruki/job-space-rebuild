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
    $cvSearchText = 'Search Resumes';
}
@endphp
<nav class="-mb-0.5 flex justify-center grid grid-cols-4" aria-label="Tabs" role="tablist" data-hs-tabs-vertical="true">
    <a @if (!$dashboard) href="/recruiter/dashboard/#job-post" @endif id="job-post-label" data-hs-tab="#job-post" role="tab" aria-controls="job-post" class="@if ($dashboard) active @endif cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>
        </div>
        {{ $createJobText }}
    </a>
    <a @if (!$dashboard && $cvCredits) href="/recruiter/dashboard/#resume-search" @endif @if ($cvCredits) id="resume-search-label" data-hs-tab="#resume-search" role="tab" aria-controls="resume-search" @else href="/rates" @endif class="cursor-pointer  tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
        </div>
        {!! $cvSearchText !!}
    </a>
    <a @if (!$dashboard) href="/recruiter/dashboard/#current-jobs" @endif id="current-jobs-label" data-hs-tab="#current-jobs" role="tab" aria-controls="current-jobs" class="cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>
        </div>
        My Jobs
    </a>
    <a @if (!$dashboard) href="/recruiter/dashboard/#users" @endif id="users-label" data-hs-tab="#users" role="tab" aria-controls="users" class="cursor-pointer  tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
        </div>
        Users
    </a>
</nav>