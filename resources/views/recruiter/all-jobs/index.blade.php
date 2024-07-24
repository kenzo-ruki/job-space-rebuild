<div class="col-span-4 md:col-span-3 border-b border-slate-300 my-9 pb-3">
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
            @foreach($allJobs as $job)
                @include('recruiter.all-jobs.card', ['job' => $job])
            @endforeach
        </tbody>
    </table>
    <!-- End Table -->
</div>