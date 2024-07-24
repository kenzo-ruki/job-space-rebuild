@php
use App\Utilities\RecruiterCredits;
use App\Models\JobCategory;
$cvCredits = RecruiterCredits::getCVCredits();
@endphp
<div>
    @if (!empty($resumes))
    {{$resumes->links()}}
    <div class="col-span-4 md:col-span-3 border-b border-slate-300 my-9 pb-9">
        <!-- Table -->
        <table class="min-w-full divide-b divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center rounded-l-full text-xs font-semibold uppercase tracking-wide text-slate-800">
                        Jobseeker
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-800 hidden sm:table-cell">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-800 hidden sm:table-cell">
                        Video Profile
                    </th>
                    <th scope="col" class="px-6 py-3 text-center rounded-r-full text-xs font-semibold uppercase tracking-wide text-slate-800">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($resumes as $resume)
                    @php
                    $jobCategoryIds = explode(',', $resume->job_category);
                    $categories = JobCategory::findMany($jobCategoryIds);
                    $categoryNames = implode(', ', $categories->pluck('category_name')->toArray());
                    @endphp
                <tr>
                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <div class="flex items-center gap-x-2">
                                @if ($resume->photo)
                                <img class="inline-block size-6 rounded-full" src="{{ asset('storage/resume_photos/' . $resume->photo) }}" alt="{{ $resume->user->first_name }}">
                                @endif
                                <div class="grow">
                                    <span class="text-sm text-center text-slate-600">{{ $resume->user->first_name . ' ' .  $resume->user->last_name }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="size-px whitespace-nowrap hidden sm:table-cell">
                        <div class="px-6 py-3">
                            <div class="flex items-center gap-x-2">
                                <span class="text-sm text-slate-600">{{ $categoryNames }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="size-px whitespace-nowrap hidden sm:table-cell">
                        <div class="px-6 py-3">
                            <div class="flex items-center gap-x-2">
                                <span class="text-sm text-slate-600">
                                    @if ($resume->user->video_path)
                                    <a href="{{ route('resume-video.watch', ['user' => $resume->user]) }}">View Video Profile</a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="size-px whitespace-nowrap">
                        <div class="p-3">
                            <div class="hs-dropdown relative inline-block [--placement:bottom-right]  text-center">
                                <button id="dropdown-resume-{{$resume->id}}" type="button" class="hs-dropdown-toggle py-2 px-2 inline-flex justify-center items-center gap-2 rounded-full border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                                </button>
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 z-10 bg-white shadow-md rounded-2xl p-4 mt-2" aria-labelledby="dropdown-resume-{{$resume->id}}">
                                    <a href="{{ route('resume.show', $resume) }}" class="py-2 px-3 flex block mb-4 items-center gap-x-1 text-xs font-medium border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        View
                                    </a>
                                    @if ($cvCredits && $resume->resume)
                                    <a href="{{ route('resume.download.recruiter', $resume) }}" class="py-2 px-3 flex block mb-4 items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        Download
                                    </a>
                                    @elseif (!$cvCredits && $resume->resume)
                                    <a href="{{ route('rates') }}" class="py-2 px-3 flex block mb-4 items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        Subscribe to download
                                    </a>
                                    @endif
                                    <a href="{{ route('resume.contact', ['resume' => $resume]) }}" class="py-2 px-3 flex block mb-2 items-center gap-x-1 text-xs font-medium border border-fuchsia-800 bg-fuchsia-100 text-fuchsia-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- End Table -->
    </div>
    {{$resumes->links()}}
    @endif
</div>