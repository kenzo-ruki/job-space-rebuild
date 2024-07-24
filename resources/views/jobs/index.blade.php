<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout>
    <div class="page default">
        <!-- Search Form -->
        <div class="job-search w-full py-24 relative z-1 overflow-hidden">
            <div class="max-w-[75rem] px-6 lg:px-0 mx-auto z-1 relative">
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
            <div class="w-full content relative pt-24 overflow-hidden px-6">
                @include('shapes.left'.$rand_shape)
                @include('shapes.right'.$rand_shape)
                <div class="max-w-[75rem] mx-auto px-6 pb-24">
                    <div class="flex grid grid-cols-5 gap-6">
                        <div class="lg:col-span-4 col-span-5">
                            <div class="w-full sticky top-0">
                                <div class="bg-white p-8 w-full h-auto shadow rounded-4xl">
                                    @livewire('search.job-search-index') 
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 lg:col-span-4 col-span-5">
                            <div class="group flex flex-col grid grid-cols-4 gap-x-12 bg-white p-8 shadow rounded-4xl w-full h-auto">
                                <div class="col-span-4 border-b border-slate-300 mb-9 pb-9">
                                @if (Auth::user() && Auth::user()->hasRole('jobseeker'))
                                    <div class="flex w-full justify-end">
                                        <a href="{{ route('jobalert.jobseeker') }}" class="my-3 py-3 px-4 rounded-4xl text-md font-bold text-white bg-cerise-red-500 hover:bg-cerise-red-600">
                                            Save Search
                                        </a>
                                    </div>
                                @endif
                                </div>
                            @foreach($jobs as $job)
                            @php
                            if ($job->job_id) {
                                \App\Utilities\JobStatAdder::view($job->job_id);
                            }
                            @endphp
                                <div class="col-span-4 border-b border-slate-300 mb-9 pb-9">
                                    <div class="text-xs text-slate-600 pb-2 flex">
                                    @foreach($job->jobCategories as $category)
                                        <a href="/jobs/category/{{$category->slug}}" class="rounded-2xl bg-slate-100 hover:bg-slate-200 py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms]">
                                            {{$category->category_name}}
                                        </a>
                                    @endforeach
                                    </div>
                                    <a href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                                        <h2 class="block my-2 text-3xl leading-7 font-semibold text-cerise-red-600 hover:text-cerise-red-700 !text-left">
                                            {{$job->job_title}}
                                        </h2>
                                    </a>
                                    <a class="text-blue-violet-800 hover:text-blue-violet-900" href="/company/{{$job->recruiter->recruiter_company_seo_name}}">
                                        {{$job->recruiter->recruiter_company_name}}
                                    </a>
                                    <p class="text-sm text-slate-500 font-thin mb-5">{{getJobCreatedAt($job)}}</p>
                                    <p class="block mt-2 mb-6">{!! $job->excerpt() !!}</p>
                                    <a class="inline-block rounded-full text-sm leading-4 font-bold px-4 py-2 mr-1 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[400ms]" href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                                        Read more
                                    </a>
                                    @livewire('save-job.save-job', ['jobId' => $job->job_id, 'saved' => false])
                                </div>
                            @endforeach
                            
                            {{$jobs->links()}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>