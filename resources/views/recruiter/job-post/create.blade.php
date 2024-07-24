@php
use App\Utilities\RecruiterCredits;

$jobCredits = RecruiterCredits::getJobCredits();
@endphp
    @if($jobCredits)
        @livewire('forms.job-post-form')
    @else
        @include('messages.raw', ['message' => 'Check out <a class="underline" href="'.route('rates').'">our rates</a> to access this feature.'])
    @endif
