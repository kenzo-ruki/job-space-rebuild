
<x-app-layout>
    @include('partials.banner', ['closable' => false])
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">

        @if(session()->has('message'))
            @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
        @endif

        @include('jobseeker.stats',  [
            'savedJobCount' => $savedJobs->count(),
            'applicationCount' => $applications->count(),
            'resumeCount' => $resumes->count(),
            'savedSearchesCount' => $jobAlerts->count(),
            'messageCount' => $messageCount,
        ])

        <div id="dashboard">
            @include('jobseeker.dashboard-menu', ['dashboard' => true])

            <div id="saved-jobs" role="tabpanel" aria-labelledby="saved-jobs-label" class="tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">Saved Jobs</h2>
                @include('jobseeker.saved-jobs.index')
            </div>
            <div id="job-alerts" role="tabpanel" aria-labelledby="job-alerts-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <div class="relative mb-12">
                    <h2 class="text-4xl font-thin text-slate-900">Saved Searches/Alerts</h2>
                    <div class="flex block w-full space-x-3 mt-3 lg:absolute lg:justify-end justify-start right-0 top-0">
                        <a href="{{ route('jobalert.jobseeker') }}" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] text-xs sm:test-sm">
                            New Job Alert
                        </a>
                    </div>
                </div>
                @include('jobseeker.job-alerts.index')
            </div>
            <div id="applications" role="tabpanel" aria-labelledby="applications-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">Applications</h2>
                @include('jobseeker.application.index')
            </div>
            <div id="resumes" role="tabpanel" aria-labelledby="resumes-label" class="hidden tab-panel bg-slate-100 border border-slate-200 border-t-0 bg-white p-8 shadow rounded-4xl sm:rounded-t-none w-full">
                <div class="relative mb-12">
                    <h2 class="text-4xl font-thin text-slate-900">Resumes</h2>
                    <div class="flex block w-full space-x-3 mt-3 lg:absolute lg:justify-end justify-start right-0 top-0">
                        @php
                        $user = Auth::user();
                        @endphp
                        @if ($resumes->count() >= 5)
                        <a href="#" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-slate-500 text-xs sm:test-sm">
                            Resume limit reached (5)
                        </a>
                        @else
                        <a href="{{route('resume.create')}}" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] text-xs sm:test-sm">
                            New Resume
                        </a>
                        @endif
                        @if ($user?->video_path)
                        <a href="{{route('resume-video.show')}}" class="rounded-full font-bold px-4 py-3 text-white bg-slate-500 hover:bg-slate-600 transition-bg duration-[600ms] text-xs sm:test-sm">
                            View Video
                        </a>
                        @endif
                        <a href="{{route('resume-video.create')}}" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-slate-500 hover:bg-slate-600 transition-bg duration-[600ms] text-xs sm:test-sm">
                            New Video
                        </a>
                    </div>
                </div>
                @include('jobseeker.resume.index')
                <div class="relative my-12">
                    <h2 class="text-4xl font-thin text-slate-900">Cover Letters</h2>
                    <div class="flex block w-full space-x-3 mt-3 lg:absolute lg:justify-end justify-start right-0 top-0">
                        <a href="{{route('cover-letter.create')}}" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] text-xs sm:test-sm">
                            New Cover Letter
                        </a>
                    </div>
                </div>
                @include('jobseeker.cover-letter.index', ['coverLetters' => $coverLetters])
            </div>
        </div>
    </div>
</x-app-layout>
