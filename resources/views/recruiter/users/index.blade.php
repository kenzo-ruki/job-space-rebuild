
<div class="col-span-4 md:col-span-3 border-b border-slate-300 my-9 pb-9">
    <!-- Table -->
    <table class="min-w-full divide-b divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($users as $user)
            <tr>
                <td class="size-px text-center text-xs whitespace-nowrap">
                    <div class="p-3">
                        <div class="flex items-center gap-x-2">
                            @if ($user?->profile_photo_path)
                            <img class="inline-block size-6 rounded-full" src="{{ asset('/storage/' . $user->profile_photo_path) }}" alt="{{ $user->first_name }}">
                            @endif
                            <div class="grow">
                                <span class="text-sm text-slate-600">{{ $user?->first_name . ' ' .  $user?->last_name }}</span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="size-px text-center text-xs whitespace-nowrap hidden md:table-cell">
                    <div class="p-3">
                        <span class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                            </svg>
                            Active
                        </span>
                    </div>
                </td>
                <td class="size-px text-center text-xs whitespace-nowrap">
                    <div class="p-3">
                        <a href="{{ route('recruiter.deactivate', ['user' => $user])}}" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium border border-cerise-red-800 bg-cerise-red-100 text-cerise-red-800 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Delete
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- End Table -->
</div>