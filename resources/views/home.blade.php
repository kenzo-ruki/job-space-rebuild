<?php

use App\Models\Slider;
$featured_employers = Slider::where('slug', '=', 'featured-employers')->get()->first();

?>
<x-app-layout>
    @if($showBanner)
    @include('partials.banner', ['closable' => true])
    @endif
    <!-- Search Form -->
    <div class="job-search w-full pt-24 pb-[14rem] relative z-1 overflow-hidden">
        <div class="max-w-[75rem] px-6 px-6 lg:px-8 mx-auto z-1 relative">
            <h2 class="text-center w-full block text-3xl font-bold text-white mb-12">Life is too short for a bad job</h2>
            @livewire('search.job-search-home') 
        </div>
    </div>
    <!-- End Search Form -->

    <!-- Employer features -->
    <div class="employer-features py-8 bg-blue-violet-600">
        <div class="max-w-[75rem] px-6 pt-12 pb-16 px-6 lg:px-8 mx-auto">
            <div class="font-semibold text-white py-1 text-center">
                <h2 class="block w-full text-4xl">EMPLOYERS</h2>
                <ul role="list" class="space-y-3 sm:space-y-6 space-x-3 sm:space-x-6 pt-6">
                    <li class="inline-flex space-x-3 justify-items-center sm:justify-items-around">
                        <!-- Solid Check -->
                        <span class="mt-0.5 h-8 w-8 hidden sm:flex justify-center items-center rounded-full bg-blue-violet-50 text-blue-violet-600">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <!-- End Solid Check -->

                        <span class="text-sm sm:text-base text-white !text-xl">
                            #1 NZ-Owned Job Site
                        </span>
                    </li>

                    <li class="inline-flex space-x-3 justify-items-center sm:justify-items-around">
                        <!-- Solid Check -->
                        <span class="mt-0.5 h-8 w-8 hidden sm:flex justify-center items-center rounded-full bg-blue-violet-50 text-blue-violet-600">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <!-- End Solid Check -->

                        <span class="text-sm sm:text-base text-white !text-xl">
                            Amazing Advertising options
                        </span>
                    </li>

                    <li class="inline-flex space-x-3 justify-items-center sm:justify-items-around">
                        <!-- Solid Check -->
                        <span class="mt-0.5 h-8 w-8 hidden sm:flex justify-center items-center rounded-full bg-blue-violet-50 text-blue-violet-600">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <!-- End Solid Check -->

                        <span class="text-sm sm:text-base text-white !text-xl">
                            Thousands of CVs available
                        </span>
                    </li>
                </ul>
                <p class="mt-6 text-center">
                    <button type="button" class="shadow-lg rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
                        Find Out More
                    </button>
                </p>
            </div>
        </div>
    </div>
    <!-- End Employer features -->

    <!-- Featured Employers -->
    <div class="max-w-[75rem] min-h-[600px] mx-auto my-24 px-6 lg:px-8">
        <h2 class="text-center w-full block text-3xl font-bold text-slate-800 mb-12">Featured Employers</h2>
        @livewire('sliders.featured-employers', ['slider' => $featured_employers])
        <!-- Grid -->
        <div class="grid md:grid-cols-3 gap-8 lg:gap-12 mb-12 mt-20">
            <div class="flex items-center justify-center sm:pl-20 md:col-span-3">
                <!-- Blockquote -->
                <blockquote class="hidden md:block relative max-w-sm">
                    <svg class="absolute top-0 start-0 transform -translate-x-12 -translate-y-14 h-24 w-24 text-slate-300" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"/>
                    </svg>
        
                    <div class="relative z-10">
                        <p class="text-2xl italic text-slate-800">
                            I would like to thank you and the team for everything you have done.
                        </p>
                    </div>
        
                    <footer class="mt-3">
                        <div class="flex items-center">
                            <div class="grow ms-4">
                            <div class="font-semibold text-slate-800">Patrick Warren</div>
                            <div class="text-xs text-slate-500">KPI Group Ltd</div>
                            </div>
                        </div>
                    </footer>
                </blockquote>
                <!-- End Blockquote -->
            </div>
        </div>
    </div>
    <!-- End Featured Employers -->

    <!-- Featured Jobs -->
    <div class="featured-jobs bg-gradient-to-b from-blue-violet-200 to-blue-violet-300">
        <div class="max-w-[75rem] min-h-[600px] mx-auto py-24 px-6 lg:px-8">
            <h2 class="text-center w-full block text-3xl font-bold text-slate-800 mb-12">Featured Jobs</h2>
            <!-- Grid -->
            <!-- Card Blog -->
            <div class="max-w-[75rem] mx-auto">
                <!-- Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-12">
                    @foreach($featuredJobs as $job)
                    @php
                    \App\Utilities\JobStatAdder::click($job->job_id);
                    @endphp
                    <!-- Card -->
                    <div class="group flex flex-col h-full bg-white shadow-lg rounded-4xl">
                        <div class="h-52 flex flex-col justify-center items-center bg-slate-100 rounded-t-4xl px-12 relative">
                            <div class="w-auto h-14 flex mr-2 absolute top-2 right-2 z-10">
                                {!! file_get_contents(public_path('img/flame.svg')) !!}
                            </div>
                            <img src="{{getRecruiterLogo($job)}}" alt="{{$job->recruiter->recruiter_company_name}}" class="mx-auto max-w-52 z-1">
                        </div>
                        <div class="p-4 md:p-6">
                            <div class="text-xs text-slate-600 pb-2 flex items-center">
                            @foreach($job->jobCategories as $category)
                                <a href="/jobs/category/{{$category->slug}}" class="rounded-2xl bg-slate-100 hover:bg-slate-200 py-2 px-4 mr-3 leading-3 transition-bg duration-[400ms]">
                                    {{$category->category_name}}
                                </a>
                            @endforeach
                            </div>
                            <a href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                                <h3 class="block my-2 text-2xl font-semibold text-cerise-red-600 hover:text-cerise-red-700">
                                    {{$job->job_title}}
                                </h3>
                            </a>
                            <a class="text-blue-violet-800 hover:text-blue-violet-900" href="/company/{{$job->recruiter->recruiter_company_seo_name}}">
                                {{$job->recruiter->recruiter_company_name}}
                            </a>
                            <p class="text-sm text-slate-500 font-thin mb-5">{{getJobCreatedAt($job)}}</p>
                            @if ($job->job_short_description) <p class="block mt-2">{{ $job->job_short_description }}</p> @endif
                        </div>
                        <div class="mt-auto flex divide-x">
                            @livewire('save-job.save-featured-job', ['jobId' => $job->job_id, 'saved' => false])
                            <a class="w-full py-4 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-br-4xl text-white bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[400ms]" href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                                Read more
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
                    @endforeach
                </div>
                <!-- End Grid -->
            </div>
            <!-- End Card Blog -->
        </div>
    </div>
    <!-- End Featured Jobs -->

    <!-- Job Notifications -->
    <div class="job-notifications relative bg-gradient-to-b from-blue-violet-400 to-blue-violet-300">
        <img class="absolute top-0 start-0 w-full" src="{{ asset('/img/wavy_shape.svg') }}" alt="wavy background">
        <div class="max-w-[75rem] min-h-[600px] mx-auto">
            <div class="font-semibold text-slate-800 py-1 text-center">
                <!-- Hero -->
                <div class="relative">
                    <div class="max-w-[75rem] px-4 pb-12 pt-32 px-6 lg:px-8 lg:pb-24 lg:pt-48 mx-auto">
                    <!-- Grid -->
                    <div class="grid items-center md:grid-cols-2 gap-8 lg:gap-12">
                        <div>
                            <!-- Title -->
                            <div class="mt-4 md:mb-12 max-w-2xl">
                                <h1 class="mb-4 font-semibold text-slate-800 text-4xl lg:text-5xl">
                                    Get job alerts straight to your inbox.
                                </h1>
                                <p class="text-slate-800">
                                    Enter your email to get started. You will be able to unsubscribe at any moment.
                                </p>
                            </div>
                            <!-- End Title -->
                        </div>
                        <!-- End Col -->
                
                        <div>
                        <!-- Form -->
                            <div class="lg:max-w-lg lg:mx-auto lg:me-0 ms-auto">
                            <!-- Card -->
                            <div class="p-4 sm:p-7 flex flex-col bg-white rounded-4xl shadow-lg">
                                <div class="text-center">
                                    <h1 class="block text-2xl font-bold text-slate-800">Set Up Job Notifications</h1>
                                </div>
                
                                <div class="mt-5">
                                    @livewire('forms.notify-form')
                                </div>
                            </div>
                            <!-- End Card -->
                            </div>
                        <!-- End Form -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->
                
                    <!-- Clients Section -->
                    <div class="mt-6 md:mt-12 py-3 flex items-center text-sm text-slate-800 gap-x-1.5 after:flex-[1_1_0%] after:border-t after:border-slate-200 after:ms-6">
                        Trusted by some of NZ's leading businesses
                    </div>
                
                    <!-- Clients -->
                    <div class="grid grid-cols-12 items-center gap-x-3 grayscale">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/Coca-Cola_logo.svg" alt="Coca-Cola">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/twl_primary_logo_rgb4x.webp" alt="The Warehouse Leader">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/noels_logo3x.png" alt="Noel Leeming">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/DOC.png" alt="Department of Corrections">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/UC-Logo.webp" alt="University of Canterbury">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/university-of-otago.png" alt="University of Otago">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/distinction-hotels-new-zealand.png" alt="Distinction Hotels">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/te-and-trust-removebg-preview.png" alt="Top Energy">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/AC-logo.png" alt="Auckland Council">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/TeWhareWananga.svg" alt="Te Whare Wananga Trust">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/logo-black.svg" alt="Silver Fern Farms">
                        <img class="w-full h-auto lg:col-span-2 md:col-span-3 col-span-6" src="/img/partnership-logo/lone-star-removebg-preview.png" alt="Lone Star">
                    </div>
                    <!-- End Clients -->
                    </div>
                    <!-- End Clients Section -->
                </div>
                <!-- End Hero -->
            </div>
        </div>
    </div>
    <!-- Job Notifications -->

</x-app-layout>
