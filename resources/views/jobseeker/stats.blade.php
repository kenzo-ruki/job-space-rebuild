<div class="grid md:grid-cols-4 border border-slate-200 shadow-sm rounded-4xl overflow-hidden mb-12">
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="/jobseeker/dashboard/#saved-jobs" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>              
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Saved Jobs
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $savedJobCount }}
                </h3>
            </div>
        </a>
        <a href="/jobseeker/dashboard#saved-jobs" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-cerise-red-500 text-sm text-white rounded-4xl hover:bg-cerise-red-600">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-white text-cerise-red-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>                            
            </div>
            View Saved Jobs
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="/jobseeker/dashboard#applications" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
            </svg>
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Applications
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600">
                    {{ $applicationCount }}
                </h3>
            </div>
        </a>
        <a href="/jobseeker/dashboard#applications" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                </svg>
            </div>
            View Applications
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="{{ route('jobseeker.messages')  }}" class="flex md:grid lg:flex gap-y-3 gap-x-5">
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
        <a href="{{ route('jobseeker.messages') }}" role="tab" aria-controls="messages" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                </svg>
            </div>
            View Messages
        </a>
    </div>
    <!-- End Card -->
    <!-- Card -->
    <div class="block p-4 md:p-5 relative bg-white hover:bg-slate-50 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-slate-200 before:first:bg-transparent">
        <a href="/jobseeker/dashboard/#resumes" class="flex md:grid lg:flex gap-y-3 gap-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-violet-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
            </svg>              
            <div class="grow">
                <p class="text-xs uppercase tracking-wide font-medium text-slate-800">
                    Resumes
                </p>
                <h3 class="mt-1 text-xl sm:text-2xl font-semibold text-blue-violet-600 items-center">
                    {{ $resumeCount }}
                </h3>
            </div>
        </a>
        <a href="/jobseeker/dashboard/#resumes" role="tab" aria-controls="subscriptions" class="w-full flex items-center gap-x-4 py-2 px-2 mt-12 bg-slate-100 border border-slate-200 text-sm text-slate-700 rounded-4xl hover:bg-slate-50">
            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                </svg>                  
            </div>
            Resumes/Letters
        </a>
    </div>
    <!-- End Card -->
</div>