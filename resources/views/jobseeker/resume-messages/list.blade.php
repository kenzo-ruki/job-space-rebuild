<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="subs"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl  w-full">
                    <h2 class="text-4xl font-thin text-slate-900 mb-12">Application Messages</h2>
                    @include('jobseeker.messages.index', ['messages' => $messages])
                    <h2 class="text-4xl font-thin text-slate-900 mb-12">Resume Messages</h2>
                    @include('jobseeker.resume-messages.index', ['messages' => $resumeMessages])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>