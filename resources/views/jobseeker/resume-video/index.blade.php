<div class="overflow-x-auto min-w-full divide-y divide-gray-200">
    <table class="min-w-full">
        <thead class="">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Categories
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Location
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden sm:table-cell">
                    Resume
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($resumes as $resume)
                @php
                    $category_ids = explode(',', $resume->job_category);
                    $categories = \App\Models\JobCategory::whereIn('id', $category_ids)->get();
                    
                    $category_names = implode(', ', $categories->pluck('category_name')->toArray());
                    $location_name = '';
                    if ($resume->region) {
                        $zone = \App\Models\Zone::where('zone_id', '=', $resume->region)->first();
                        $location_name = $zone->zone_name;
                    }
                    if ($resume->country) {
                        $country = \App\Models\Country::where('id', '=', $resume->country)->first();
                        $location_name = ($location_name) ? $location_name . ', ' . $country->name : $country->name;
                    }
                    $resume_file = $resume->resume ? '<a href="' . Storage::url($resume->resume) . '" download>Resume</a>' : '';
                @endphp
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $resume->title }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
                        {{ $category_names }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
                        {{ $location_name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 hidden sm:table-cell">
                        {!! $resume_file !!}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        <a href="{{ route('resume.show', $resume) }}" class="text-indigo-600 hover:text-indigo-700">Edit</a>
                        <form method="POST" action="{{ route('resume.destroy', $resume->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>