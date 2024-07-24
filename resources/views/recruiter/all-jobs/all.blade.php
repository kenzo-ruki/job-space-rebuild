<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="all-jobs"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl  w-full">
                    <h2 class="text-4xl font-thin text-slate-900">All Jobs</h2>
                    {{$allJobs->links()}}
                    <form method="GET" action="{{ route('job.all') }}" class="flex justify-end">
                        <label for="search" class="sr-only">Search</label>
                        <div class="flex rounded-full shadow-sm">
                            <input type="text" id="search" name="search" class="px-4 block w-full border-slate-300 shadow-sm rounded-s-full text-sm">
                            <button type="submit" class="w-[2.8rem] h-[2.4rem] flex-shrink-0 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-full border border-transparent bg-cerise-red-500 text-white hover:bg-blue-700">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </button>
                        </div>
                    </form>
                    @include('recruiter.all-jobs.index', ['allJobs' => $allJobs])
                    {{$allJobs->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
