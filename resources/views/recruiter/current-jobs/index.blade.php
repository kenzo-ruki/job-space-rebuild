<div class="col-span-4 md:col-span-3 border-b border-slate-300 my-9 pb-3">
    <div id="current-jobs-tab">
        <p class="w-full mx-auto mb-6">
            <a href="{{ route('job.all') }}" class="inline-flex items-center rounded-full font-bold px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] h-12">
                All Jobs
            </a>
        </p>
        <!-- Table -->
        <table class="min-w-full divide-b divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                        Created
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                        Expiry
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                        Views
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                        Applied
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($currentJobs as $job)
                    @include('recruiter.current-jobs.card', ['job' => $job])
                @endforeach
            </tbody>
        </table>
        <!-- End Table -->
    </div>
</div>