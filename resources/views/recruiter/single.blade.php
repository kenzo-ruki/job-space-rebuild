<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout>
    <div class="company default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$recruiter->recruiter_company_name}}</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            @if($recruiter->recruiter_description)
            <div class="relative max-w-[75rem] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mb-36">
                @if(!empty($recruiter->recruiter_logo))
                <div class="aspect-w-16 aspect-h-9 mb-9">
                    <img src="{{$recruiter->getLogo()}}" class="h-auto w-full lg:w-2/3 lg:mx-auto object-cover rounded-2xl" alt="{{$recruiter->recruiter_company_name}}">
                </div>
                @endif
                <div class="body text-lg text-slate-800">
                    {!! $recruiter->recruiter_description !!}
                </div>
            </div>
            @endif
            <div id="current-jobs" class="relative max-w-[75rem] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mb-36">
                <h2 class="text-4xl font-thin text-slate-900 mb-12">Live Jobs</h2>
                @foreach($jobs as $job)
                @php
                \App\Utilities\JobStatAdder::view($job->job_id);
                @endphp
                    <div class="col-span-4 md:col-span-3 border-b border-slate-300 mb-9 pb-9">
                        <div class="text-xs text-slate-600 pb-2 flex">
                        @foreach($job->jobCategories as $category)
                            <a href="/jobs/category/{{$category->slug}}" class="rounded-2xl bg-slate-100 hover:bg-slate-200 py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms]">
                                {{$category->category_name}}
                            </a>
                        @endforeach
                        </div>
                        <a href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                            <h3 class="block my-2 text-3xl leading-7 font-semibold text-cerise-red-600 hover:text-cerise-red-700">
                                {{$job->job_title}}
                            </h3>
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
            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>