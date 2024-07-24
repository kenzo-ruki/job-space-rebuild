<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="subs"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl w-full">
                    <h2 class="text-4xl font-thin text-slate-900 mb-6">Contact {{ $jobseeker->first_name }} {{ $jobseeker->last_name }}</h2>
                    @if ($message)
                    <p class="mb-4">Previous Message Subject:</p>
                    <h4 class="my-6">{{ $message->subject }}</h4>
                    <div class="mb-6">
                        <p class="mb-4">Previous Message Text:</p>
                        {!! $message->message !!}
                    </div>
                    @endif
                    @if (isset($application))
                    @livewire('forms.contact-applicant-form', ['message' => $message, 'application' => $application, 'jobseeker' => $jobseeker])
                    @else
                    @livewire('forms.contact-resume-form', ['message' => $message, 'resume' => $resume, 'jobseeker' => $jobseeker])
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>