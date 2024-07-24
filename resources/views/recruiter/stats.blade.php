@php
    $svgContent = file_get_contents(public_path('/img/infinity.svg'));
    $svgContent = preg_replace('/<svg /', '<svg class="h-9 w-9 fill-blue-violet-600 flex inline-flex" ', $svgContent);
@endphp
<div class="grid md:grid-cols-4 border border-slate-200 shadow-sm rounded-4xl overflow-hidden mb-12">
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="/recruiter/dashboard/#company" class="text-blue-violet-600">
            <div class="flex flex-col items-center">
                <h3 class="mb-4">
                    {{$recruiter->recruiter_company_name}}
                </h3>
                @if(!empty($recruiter->recruiter_logo))
                    <img src="{{$recruiter->getLogo()}}" class="h-auto w-full mx-auto" alt="{{$recruiter->recruiter_company_name}}">
                @endif
            </div>
        </a>
        <a href="/recruiter/dashboard/#company" role="tab" aria-controls="messages" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
            </div>
           Company
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="/recruiter/dashboard/#current-jobs" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
            </svg>
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Jobs
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $currentJobs->count() }}
                </h3>
            </div>
        </a>
        <a href="/recruiter/dashboard/#current-jobs" class="flex md:grid lg:flex gap-y-3 gap-x-5 mt-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>              
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Views
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $totalViews }}
                </h3>
            </div>
        </a>
        <a href="/recruiter/dashboard/#current-jobs" class="flex md:grid lg:flex gap-y-3 gap-x-5 mt-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
            </svg>
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Applications
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $currentApplications->count() }}
                </h3>
            </div>
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="{{ route('recruiter.messages')  }}" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Messages
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $messageCount }}
                </h3>
            </div>
        </a>
        <a href="{{ route('recruiter.messages') }}" role="tab" aria-controls="messages" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
            View Messages
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="{{ route('recruiter.subscriptions')  }}" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
            </svg>
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Job Credits / Resume Credits
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600 items-center">
                    {!! ($jobCredits == 2147483647) ? $svgContent : $jobCredits !!} / {{ $cvCredits }}
                </h3>
            </div>
        </a>
        <a href="{{ route('recruiter.subscriptions') }}" role="tab" aria-controls="subscriptions" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
            Subs
        </a>
    </div>
    <!-- End Card -->
</div>
