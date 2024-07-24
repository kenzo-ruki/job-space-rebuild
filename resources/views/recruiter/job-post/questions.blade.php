<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 lg:mt-0 lg:col-span-3 col-span-5">
                <!-- Start Apply Section -->
                <div id="all-jobs"  class="bg-white p-8 shadow rounded-4xl w-full">
                    <h2 class="text-4xl font-thin text-slate-900">Add Screening Questions - {{ $job->job_title }}</h2>
                    @livewire('forms.job-post-questions-form', ['job' => $job])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>