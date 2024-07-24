<?php
    use App\Repositories\SearchRepository;
    $searchRepository = new SearchRepository();
?>
<div class="overflow-x-auto min-w-full divide-y divide-gray-200">
    <table class="min-w-full">
        <thead class="">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden sm:table-cell">
                    Category
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Keywords
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Location
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($savedSearches as $search)
                <tr>
                    <td class="size-px text-center text-xs font-bold">
                        <div class="p-3">
                            <a href="{{ $searchRepository->getSearchLink($search) }}" target="_blank" class="text-bold text-cerise-red-600">{{ ucfirst($search->title) }}</a>
                        </div>
                    </td>
                    <td class="size-px text-center text-xs whitespace-nowrap hidden sm:table-cell">
                        <div class="p-3">
                            {{ ucfirst($search->category) }}
                        </div>
                    </td>
                    <td class="size-px text-center text-xs whitespace-nowrap hidden md:table-cell">
                        <div class="p-3">
                            {{ ucfirst($search->keywords) }}
                        </div>
                    </td>
                    <td class="size-px text-center text-xs whitespace-nowrap hidden md:table-cell">
                        <div class="p-3">
                            {{ ucfirst($search->location) }}
                        </div>
                    </td>
                    <td class="size-px text-center text-xs whitespace-nowrap">
                        <div class="p-3">
                            <div class="hs-dropdown relative inline-block [--placement:bottom-right]">
                                <button id="dropdown-search-{{$search->id}}" type="button" class="hs-dropdown-toggle py-2 px-2 inline-flex justify-center items-center gap-2 rounded-full border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                                </button>
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 z-10 bg-white shadow-md rounded-2xl p-4 mt-2" aria-labelledby="dropdown-{{$job->job_id}}">
                                    <a href="{{ $searchRepository->getSearchLink($search) }}" class="py-2 px-3 flex block mb-4 items-center gap-x-1 text-xs font-medium border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('saved-searches.edit', ['saved_search' => $search]) }}" class="py-2 px-3 flex block mb-4 items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('saved-searches.destroy', $search) }}" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-2 px-3 flex block w-full mb-2 items-center gap-x-1 text-xs font-medium border border-cerise-red-800 bg-cerise-red-100 text-cerise-red-800 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>