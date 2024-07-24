<div class="overflow-x-auto min-w-full divide-y divide-gray-200">
    <table class="min-w-full">
        <thead class="">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($resumeVideos as $resumeVideo)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $resumeVideo->title }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        <a href="{{ route('resume-video.show', $resumeVideo->id) }}" class="text-indigo-600 hover:text-indigo-700">View</a>
                        <form method="POST" action="{{ route('resumeVideo.destroy', $resumeVideo->id) }}">
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