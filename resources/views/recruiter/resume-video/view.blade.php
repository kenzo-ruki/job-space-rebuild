<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 lg:mt-0 lg:col-span-3 col-span-4">
                <!-- Start Apply Section -->
                <div id="apply" class="bg-white p-8 shadow-md rounded-4xl w-full"><!-- Card Section -->
                    <div class="relative items-center">
                        <h2 class="text-4xl font-thin text-slate-900 mb-4">Video Profile for {{ $user->first_name }} {{ $user->last_name }}</h2>
                        </div>
                    </div>
                    <div class="max-w-4xl px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">    <div>
                        <div class="flex w-full bg-white shadow rounded-4xl overflow-hidden mx-auto mt-12 p-8">
                            <div class="flex flex-col m-5">
                                <div class="relative">
                                    <video class="w-screen"  controls="true" autoplay="">
                                        <source src="{{route('resume-video.view', ['user' => $user])}}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
