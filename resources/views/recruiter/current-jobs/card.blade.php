@php
    use App\Models\Application;
@endphp
<tr>
    <td class="size-px text-center text-xs font-bold">
        <div class="p-3">
            <a href="/job/{{$job->job_id}}/edit/" target="_blank" class="text-bold text-cerise-red-600">{{ $job->job_title }}</a>
        </div>
    </td>
    <td class="size-px text-center text-xs whitespace-nowrap hidden lg:table-cell">
        <div class="p-3">
            {{ $job->re_adv?->format('d-m-Y') ?? 'Draft' }}
        </div>
    </td>
    <td class="size-px text-center text-xs whitespace-nowrap hidden lg:table-cell">
        <div class="p-3">
            {{ $job->expired?->format('d-m-Y') ?? 'Draft' }}
        </div>
    </td>
    <td class="size-px text-center text-xs whitespace-nowrap hidden md:table-cell">
        <div class="p-3">
            {{ $job->jobStatistics?->viewed }}
        </div>
    </td>
    <td class="px-6 py-4 text-sm text-slate-500 hidden lg:table-cell">
        <div class="flex block justify-center space-x-3 mt-3 w-full">
            @php
                $jobApplications = Application::where('job_id', $job->job_id)->count();
            @endphp
            @if($jobApplications)
            <a href="{{ route('applications.list', ['job' => $job]) }}" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 rounded-full mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                {{ $jobApplications }}
            </a>
            @endif
        </div>
    </td>
    <td class="size-px text-center text-xs px-6 py-4 text-sm text-slate-500 hidden lg:table-cell">
        <div class="flex block justify-center space-x-3 mt-3 w-full">
            @if (null === $job->expired)
            <span class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-slate-800 bg-slate-100 text-slate-800 rounded-full">
                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                </svg>
                Draft
            </span>
            @elseif ($job->expired->isPast())
            <span class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-cerise-red-800 bg-cerise-red-100 text-cerise-red-800 rounded-full">
                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                </svg>
                Expired
            </span>
            @else
            <span class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                </svg>
                Active
            </span>
            @endif
        </div>
    </td>
    <td class="size-px text-center text-xs whitespace-nowrap">
        <div class="p-3">
            <div class="hs-dropdown relative inline-block [--placement:bottom-right]">
                <button id="dropdown-{{$job->job_id}}" type="button" class="hs-dropdown-toggle py-2 px-2 inline-flex justify-center items-center gap-2 rounded-full border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 z-10 bg-white shadow-md rounded-2xl p-4 mt-2" aria-labelledby="dropdown-{{$job->job_id}}">
                    <a href="/jobs/{{$job->job_id}}/{{$job->slug}}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        View
                    </a>
                    <a href="{{ route('job.duplicate', ['job' => $job]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-sky-800 bg-sky-100 text-sky-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                        </svg>                          
                        Duplicate
                    </a>
                    <a href="{{ route('job.expire', ['job' => $job]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-cerise-red-800 bg-cerise-red-100 text-cerise-red-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Expire
                    </a>
                    <a href="{{ route('job.edit', ['job' => $job]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('job.download', ['job' => $job]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-purple-800 bg-purple-100 text-purple-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>                          
                        Download
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>