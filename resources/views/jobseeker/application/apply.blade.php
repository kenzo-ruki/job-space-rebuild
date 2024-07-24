<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <!-- End Apply Section -->
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div class="bg-white p-8 shadow rounded-4xl  w-full h-auto">
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
                        <a class="text-blue-violet-violet-800 hover:text-blue-violet-violet-900" href="/company/{{$job->recruiter->recruiter_company_seo_name}}">
                            {{$job->recruiter->recruiter_company_name}}
                        </a>
                        <p class="text-sm text-slate-500 font-thin mb-5">{{getJobCreatedAt($job)}}</p>
                        <p class="block mt-2 mb-6">{!! $job->excerpt() !!}</p>
                        <a class="inline-block rounded-full text-sm leading-4 font-bold px-4 py-2 mr-1 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[400ms]" href="/jobs/{{$job->job_id}}/{{$job->slug}}">
                            Read more
                        </a>
                        @livewire('save-job.save-job', ['jobId' => $job->job_id, 'saved' => false])
                    </div>
                </div> 
                <div class="bg-white p-8 shadow rounded-4xl w-full h-auto mt-12">
                    <div class="px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
                        @livewire('forms.apply-form', compact('resumes', 'job', 'application', 'coverLetters'))
                    </div>
                    <!-- End Card Section -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
