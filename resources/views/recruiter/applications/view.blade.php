<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 lg:mt-0 lg:col-span-3 col-span-5">
                <div id="view-application"  class="bg-white p-8 shadow rounded-4xl w-full">
                    <!-- Section -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-4 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-slate-800">
                                Resume
                            </h2>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="first_name" class="inline-block text-sm font-semibold text-slate-500 mt-2.5">
                                Full name
                            </label>
                        </div>
                        <!-- End Col -->
                        <div class="sm:col-span-9">
                            <p class="inline-block text-sm font-medium text-slate-500 mt-2.5">{{ $user->first_name }} {{ $user->last_name }}</p>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="email" class="inline-block text-sm font-semibold text-slate-500 mt-2.5">
                                Email
                            </label>
                        </div>
                        <!-- End Col -->
                        <div class="sm:col-span-9">
                            @if (1 !== $resume->user->contact_details_visibility && '1' !== $resume->user->contact_details_visibility)
                            <p class="inline-block text-sm font-medium text-slate-500 mt-2.5">{{ $user->email }}</p>
                            @else
                            <p class="inline-block text-sm font-medium text-slate-500 mt-2.5">**************</p>
                            @endif
                        </div>
                        <!-- End Col -->

                        @if ($resume->resume)
                        <div class="sm:col-span-3">
                            <label for="resume" class="inline-block text-sm font-semibold text-slate-500 mt-2.5">
                                Resume File
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <p class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                                <a href="{{ route('resume.download.application', ['resume' => $resume, 'application' => $application]) }}" class="text-cerise-red-500">{{$resume->title}}</a>
                            </p>
                        </div>
                        @endif
                        <div class="sm:col-span-3">
                            <div class="inline-block">
                                <label for="cover_text" class="inline-block text-sm font-semibold text-slate-500 mt-2.5">
                                    Cover Letter Text
                                </label>
                            </div>
                        </div>
                        <div class="sm:col-span-9">
                            {!! $application->cover_letter !!}
                        </div>
                        @if(!empty($application->jobQuestionResponses))
                            @foreach ($application->jobQuestionResponses as $index => $response)
                            <div class="sm:col-span-3">
                                <label for="resume" class="inline-block text-sm font-semibold text-slate-500 mt-2.5">
                                    Question {{ $index + 1 }}:
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <p class="inline-block text-sm font-semibold text-slate-500">{{ $response['question'] }}</p>
                            </div>
                            <div class="sm:col-start-4 sm:col-end-12">
                                <p class="inline-block text-sm font-medium text-slate-500 mt-1">{{ $response['response'] }}</p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
