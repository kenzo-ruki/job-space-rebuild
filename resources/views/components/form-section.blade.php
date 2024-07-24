@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="bg-white p-8 shadow {{ isset($actions) ? 'rounded-tl-2xl rounded-tr-2xl' : 'rounded-2xl' }}">
                <div class="grid grid-cols-6 gap-8">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end p-8 bg-slate-50 text-end shadow sm:rounded-bl-2xl sm:rounded-br-2xl">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
