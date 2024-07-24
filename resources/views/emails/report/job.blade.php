<x-mail::message>
{{-- Greeting --}}
# @lang('Hello!')

{{-- Intro Lines --}}
{!! $introLines !!}

{{-- Action Button --}}
@isset($actionText)
<?php $color = 'success'; ?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
{!! $outroLines !!}


{{-- Salutation --}}
@lang('Regards'),<br>
{{ config('app.name') }}

</x-mail::message>
