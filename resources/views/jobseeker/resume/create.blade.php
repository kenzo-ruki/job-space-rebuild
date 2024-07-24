@php
$user = auth()->user();
$noResume =  $user->hasResume() ? false : true;
@endphp
<x-app-layout>
    @if ($noResume)
    @include('partials.resume-banner')
    @endif
    <div class="max-w-[75rem] mx-auto px-6 pt-20 pb-24">
        <div id="dashboard">
            <div class="mt-6 sm:mt-0 lg:col-span-3 col-span-4">
                <!-- Start Apply Section -->
                <div id="apply" class="bg-white p-8 shadow rounded-4xl w-full">
                    <div class="max-w-4xl px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
                        @livewire('forms.resume-form')
                    </div>
                </div>
                <!-- End Apply Section -->
            </div>
        </div>
    </div>
</x-app-layout>