
<nav class="-mb-0.5 flex justify-center grid grid-cols-4" aria-label="Tabs" role="tablist" data-hs-tabs-vertical="true">
    <a @if (!$dashboard) href="/jobseeker/dashboard/#saved-jobs" @endif id="saved-jobs-label" data-hs-tab="#saved-jobs" role="tab" aria-controls="saved-jobs" class="@if($dashboard) active @endif cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>
        </div>
        Jobs
    </a>
    <a @if (!$dashboard) href="/jobseeker/dashboard/#job-alerts" @endif id="job-alerts-label" data-hs-tab="#job-alerts" role="tab" aria-controls="job-alerts" class="cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
            </svg>
        </div>
        Searches/Alerts
    </a>
    <a @if (!$dashboard) href="/jobseeker/dashboard/#applications" @endif id="applications-label" data-hs-tab="#applications" role="tab" aria-controls="applications" class="cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
            </svg>
        </div>
        Applied
    </a>
    <a @if (!$dashboard) href="/jobseeker/dashboard/#resumes" @endif id="resumes-label" data-hs-tab="#resumes" role="tab" aria-controls="resumes" class="cursor-pointer tab-panel-label flex items-center col-span-2 md:col-span-1 gap-x-4 py-3 px-3 bg-slate-100 border border-slate-200 border-b-0 text-sm text-slate-700 rounded-4xl md:rounded-b-none mb-4 md:mb-0 hover:bg-slate-50">
        <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-violet-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
            </svg>  
        </div>
        Resumes/Letters
    </a>
</nav>