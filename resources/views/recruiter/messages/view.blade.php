<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="subs"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl w-full">
                    <h2 class="text-4xl font-thin text-slate-900 mb-6">@if($message->sender === 'recruiter' || $message->jobseeker_id === 0) To @else From @endif {{ $jobseeker->first_name }} {{ $jobseeker->last_name }}</h2>
                    <p class="mb-4">Subject:</p>
                    <h4 class="my-6">{{ $message->subject }}</h4>
                    <p class="mb-4">Date:</p>
                    <p class="mb-6">{{ $message->created_at }}</p>
                    <p class="mb-4">Text:</p>
                    {!! $message->message !!}
                    @if($message->attachment_file) {{-- If there is an attachment --}}
                    <p class="mb-4">Attached:</p>
                    <p class="mb-6">
                        <a href="{{ route('recruiter.message.attachment', ['message' => $message]) }}" class="text-cerise-red-500">Download attachment</a>
                    </p>
                    @endif
                    @if($message->application_id)
                    <div class="w-full flex">
                        <a href="{{ route('application.review', ['application' => $application]) }}" class="inline-flex items-center gap-x-4 py-2 pl-2 pr-6 mt-12 bg-cerise-red-500 text-sm text-white rounded-4xl hover:bg-cerise-red-600">
                            <div class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-white text-cerise-red-500 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                </svg>                              
                            </div>
                            Review Application
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>