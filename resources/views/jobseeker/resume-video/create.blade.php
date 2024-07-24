<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 lg:mt-0 lg:col-span-3 col-span-4">
                <!-- Start Apply Section -->
                <div id="apply" class="bg-white p-8 shadow rounded-4xl w-full"><!-- Card Section -->
                    <h2 class="text-4xl font-thin text-slate-900 mb-4">Record A Video Profile</h2>
                    <p class="text-lg font-bold text-cerise-red-500">3 Simple steps to get your video profile</p>
                    <ol class="list-decimal list-inside text-slate-800">
                        <li>Start recording your video</li>
                        <li>Talk about your skills, experience and achievements</li>
                        <li>Upload it on your profile & update your profile</li>
                    </ol>
                    <p class="text-lg font-bold text-cerise-red-500 mt-3">Why a Video Profile is Important?</p>
                    <ol class="list-decimal list-inside text-slate-800">
                        <li>Make the right impression in 1 minute!</li>
                        <li>Stand out with a Video Profile to convince recruiters that you are the best candidate!</li>
                    </ol>
                    <p id="error-text" class="text-lg font-bold text-cerise-red-500 py-6 hidden"></p>
                    <p id="success-text" class="text-lg font-bold text-blue-violet-500 py-6 hidden"></p>
                    <div class="max-w-4xl px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
                        @livewire('forms.resume-video-form')
                    </div>
                    <!-- End Card Section -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
