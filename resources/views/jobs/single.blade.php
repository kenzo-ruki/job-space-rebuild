<?php

use Carbon\Carbon;
use App\Utilities\JobStatAdder;

$rand_shape = rand(1, 3);
$jobTypes = getJobTypes($job->job_type);
$jobLocation = getJobLocation($job);
$currentUrl = url()->current();
$salary = getJobSalary($job);
$recruiterLogo = $job->recruiter->getLogo();

JobStatAdder::click($job->job_id);
?>
<x-app-layout>
    <div class="blog default">
        <!-- Title -->
        <div class="w-full title banner">
            <div class="max-w-[75rem] mx-auto lg:w-2/3 py-20 lg:py-24 px-12 lg:px-24">
                @if (!empty($job->jobCategories) || !empty($job->jobSubCategories))
                    @foreach ($job->jobSubCategories as $subCategory)
                        @php
                        $category = \App\Models\JobCategory::find($subCategory->job_category_id);
                        @endphp
                            <a href="{{ route('jobs.sub_category', ['category' => $category->slug, 'sub_category' => $subCategory->slug]) }}"
                                class="rounded-2xl bg-slate-100 inline-block py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms] mb-6">
                                {{ $subCategory->sub_category_name }}
                            </a>
                            @if (!empty($job->jobCategories))
                                @foreach ($job->jobCategories as $category)
                                    <a href="{{ route('jobs.category', ['category' => $category->slug]) }}"
                                        class="rounded-2xl bg-slate-100 inline-block py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms] mb-6">
                                        {{ $category->category_name }}
                                    </a>
                                @endforeach
                            @endif
                    @endforeach
                    @if (empty($job->jobSubCategories) && !empty($job->jobCategories))
                        @foreach ($job->jobCategories as $category)
                            <div class="rounded-2xl bg-slate-100 inline-block py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms] mb-6">
                                <a href="{{ route('jobs.category', ['category' => $category->slug]) }}">
                                    {{ $category->category_name }}
                                </a>
                            </div>
                        @endforeach
                    @endif
                @endif
                <div class="flex flex-col grid grid-cols-1 lg:grid-cols-3 gap-x-24">
                    <h2
                        class="flex col-span-3 lg:col-span-2 mb-6 lg:mb-3 text-4xl leading-10 font-semibold text-white relative">
                        @if ($job->job_featured === 'Yes')
                        <div class="w-auto h-9 flex mr-2 absolute top-2 right-2 z-10">
                            {!! file_get_contents(public_path('img/flame.svg')) !!}
                        </div>
                        @endif
                        {{ $job->job_title }}
                    </h2>
                </div>
                <p class="block text-lg text-white">{{ $job->display_id }}</p>
                @if (!empty($jobLocation))
                <p class="block text-lg text-white">{{ $jobLocation }}</p>
                @endif
                <ul class="text-white font-thin mb-6">
                    @if (!empty($jobTypes))
                        <li
                            class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-white before:rounded-full">
                            {{ implode(', ', $jobTypes) }}
                        </li>
                    @endif
                    @if ($salary)
                        <li
                            class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-white before:rounded-full">
                            {{ $salary }}
                        </li>  
                     @endif
                    <li
                        class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-white before:rounded-full">
                        {{ getJobCreatedAt($job) }}
                    </li>
                </ul>
                <div
                    class="flex justify-left items-center space-x-2 col-span-3 lg:col-span-1 items-center mb-6 lg:mb-3">
                    <a class="flex-shrink-0 rounded-full leading-7 mr-2 font-bold px-4 py-2 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[400ms]"
                        href="/apply/{{ $job->job_id }}/">
                        Apply now
                    </a>
                    @livewire('save-job.save-job', ['jobId' => $job->job_id, 'saved' => false])
                    <svg data-sharer="email" data-title="{{ $job->job_title }}"
                        data-url="{{ $currentUrl }}"
                        class="flex-shrink-0 text-cerise-red-500 hover:text-cerise-red-600 w-6 h-6 cursor-pointer leading-10"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            @include('shapes.left' . $rand_shape)
            @include('shapes.right' . $rand_shape)
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mb-36 lg:flex">
                <div class="group flex flex-col grid grid-cols-1 lg:grid-cols-2 gap-x-24 lg:w-2/3">
                    @if ($job->job_short_description)
                        <p class="block col-span-3 mb-6 border-b border-slate-300 mb-6 pb-6 text-lg">{{ $job->job_short_description }}
                        </p>
                    @endif

                    <div class="body col-span-3 text-lg text-slate-800 space-y-3 md:space-y-5 mb-6">
                        {!! $job->job_description !!}
                    </div>


                    <div class="md:max-w-2xl col-span-3 mb-6">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            @foreach ($job->images as $image)
                            <div class="w-full">
                                <img class="w-full sm:size-40 object-cover" src="{{ Storage::url($image->image_url) }}" alt="{{ $image->alt ?? 'Job image' }}">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="inline-flex col-span-3 w-full justify-left items-center space-x-2 mb-6">
                        <a class="flex-shrink-0 rounded-full leading-7 mr-2 font-bold px-4 py-2 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[400ms]"
                            href="/apply/{{ $job->job_id }}/">
                            Apply now
                        </a>
                        @livewire('save-job.save-job', ['jobId' => $job->job_id, 'saved' => false])
                        <svg data-sharer="email" data-title="{{ $job->job_title }}" data-url="{{ $currentUrl }}"
                            class="flex-shrink-0 text-cerise-red-500 hover:text-cerise-red-600 w-6 h-6 cursor-pointer leading-10"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                    </div>
                    <div class="hs-accordion-group block mt-6 w-full col-span-3">
                        <div class="hs-accordion" id="hs-basic-with-arrow-heading-one">
                            <button
                                class="hs-accordion-toggle hs-accordion-active:text-cerise-red-700 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-cerise-red-500 hover:text-cerise-red-600"
                                aria-controls="hs-basic-with-arrow-collapse-one">
                                <svg class="hs-accordion-active:hidden block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>
                                Report This Job
                            </button>
                            <div id="hs-basic-with-arrow-collapse-one"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-arrow-heading-one">
                                @livewire('forms.report-job-form', ['job' => $job])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3 lg:pl-6 px-6">
                    @if ($recruiterLogo)
                    <div class="w-full">
                        <img class="w-2/3 mx-auto" src="{{ $recruiterLogo }}" alt="{{ $job->recruiter->recruiter_company_name }}">
                    </div>
                    @endif
                    <a class="block text-lg text-blue-violet-600 hover:text-blue-violet-800 text-center mt-6"
                        href="/company/{{ $job->recruiter->recruiter_company_seo_name }}">
                        {{ $job->recruiter->recruiter_company_name }}
                    </a>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>

</x-app-layout>
