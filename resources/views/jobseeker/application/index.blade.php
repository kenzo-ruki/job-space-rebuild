<div class="overflow-x-auto min-w-full divide-y divide-gray-200">
    <table class="min-w-full">
        <thead class="">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Job Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Applied on
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($applications as $application)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $application->job->job_title }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
                        {{ $application->created_at->format('Y-m-d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>