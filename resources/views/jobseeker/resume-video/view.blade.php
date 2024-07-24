<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 lg:mt-0 lg:col-span-3 col-span-4">
                <!-- Start Apply Section -->
                <div id="apply" class="bg-white p-8 shadow-md rounded-4xl w-full"><!-- Card Section -->
                    @if ($recruiter)
                    @php
                    $user = App\Models\User::findOrFail($video->user_id);
                    @endphp
                    <h2 class="text-4xl font-thin text-slate-900 mb-4">{{ $user ? $user->first_name . ' ' . $user->last_name : '' }} Video Profile</h2>
                    @else
                    <div class="relative items-center">
                        <h2 class="text-4xl font-thin text-slate-900 mb-4">Your Video Profile</h2>
                        <div class="flex block w-full space-x-3 mt-3 lg:absolute lg:justify-end justify-start right-0 -top-3">
                            <a href="{{route('resume-video.create')}}" class="inline-block rounded-full font-bold px-4 py-3 text-white bg-slate-500 hover:bg-slate-600 transition-bg duration-[600ms]">
                                Record A New Video
                            </a>
                        </div>
                    </div>
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
                    @endif
                    <div class="max-w-4xl px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
                        <div class="flex w-full bg-white shadow rounded-4xl overflow-hidden mx-auto mt-12 p-8">
                            <div class="flex flex-col m-5">
                                <div class="relative">
                                    <video class="w-screen"  controls="true" autoplay="">
                                        <source src="{{asset('storage/videos/'. $video->video_path)}}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card Section -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
