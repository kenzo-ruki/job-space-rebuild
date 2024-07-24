@php
use App\Utilities\RecruiterCredits;
$cvCredits = RecruiterCredits::getCVCredits();
@endphp
<x-app-layout>
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <div id="resume-search"  class="bg-white p-8 shadow border border-slate-200 border-t-0 shadow rounded-4xl w-full">
                    <h2 class="text-4xl font-thin text-slate-900 mb-12">Resume/CV Search</h2>
                    @if($cvCredits)
                        @include('recruiter.resume-search.card')
                        @include('recruiter.resume-search.index', ['resumes' => $resumes])
                    @else
                        @include('messages.message', ['message' => 'Check out our <a href="'.route('rates').'">rates</a> to access this feature.'])
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>