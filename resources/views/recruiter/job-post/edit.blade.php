<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="subs"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl  w-full">
                    <h2 class="text-4xl font-thin text-slate-900">Edit Job</h2>
                    @livewire('forms.job-post-form', ['job' => $job])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>