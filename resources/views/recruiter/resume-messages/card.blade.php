@php
$message = App\Models\ResumeInteraction::find($message->id);
$resume = App\Models\Resume::where('id', $message->resume_id)->first();
$recruiter = null;
$jobseeker = null;
if ($message->sender === 'recruiter' && $message?->recruiter_id) {
    $recruiter = App\Models\Recruiter::where('recruiter_id', $message->recruiter_id)->first();
    $jobseeker = App\Models\User::where('jobseeker_id', $message->jobseeker_id)->first();
}
if ($message->sender === 'jobseeker' && $message?->jobseeker_id) {
    $recruiter = App\Models\Recruiter::where('recruiter_id', $message->recruiter_id)->first();
    $jobseeker = App\Models\User::where('jobseeker_id', $message->jobseeker_id)->first();
}
@endphp
<tr>
    <td class="size-px text-center text-xs px-6 py-4 text-sm text-slate-500 hidden lg:table-cell">
        <div class="p-3">
            {{ $message->created_at->format('Y-m-d') }}
        </div>
    </td>
    <td class="size-px text-center text-xs px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
        <div class="p-3">
            {{ $message->subject }}
        </div>
    </td>
    <td class="size-px text-center text-xs px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
        <div class="p-3">
            @if($message->sender === 'recruiter' && !empty($recruiter))
                From: {{ $recruiter->recruiter_first_name }} {{ $recruiter->recruiter_last_name }}
            @endif
            @if($message->sender === 'recruiter'  && !empty($jobseeker))
                To: {{ $jobseeker->first_name }} {{ $jobseeker->last_name }}
            @endif
            @if($message->sender === 'jobseeker' && !empty($recruiter))
                From: {{ $recruiter->recruiter_first_name }} {{ $recruiter->recruiter_last_name }}
            @endif
            @if($message->sender === 'jobseeker'  && !empty($jobseeker))
                To: {{ $jobseeker->first_name }} {{ $jobseeker->last_name }}
            @endif
        </div>
    </td>
    <td class="size-px text-center text-xs whitespace-nowrap">
        <div class="p-3">
            <div class="hs-dropdown relative inline-block [--placement:bottom-right]">
                <button id="dropdown-{{$message->id}}" type="button" class="hs-dropdown-toggle py-2 px-2 inline-flex justify-center items-center gap-2 rounded-full border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 z-10 bg-white shadow-md rounded-2xl p-4 mt-2" aria-labelledby="dropdown-{{$message->id}}">
                    <a href="{{ route('recruiter.resume-message.view', ['message' => $message->id]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-blue-violet-800 bg-blue-violet-100 text-blue-violet-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        View
                    </a>
                    <a href="{{ route('recruiter.resume-message.reply', ['message' => $message->id]) }}" class="py-2 px-3 mb-4 flex block items-center gap-x-1 text-xs font-medium border border-teal-800 bg-teal-100 text-teal-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        Reply
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>