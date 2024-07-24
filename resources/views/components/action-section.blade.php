<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-6 md:mt-0 md:col-span-3">
        <div class="p-8 bg-white shadow rounded-4xl">
            {{ $content }}
        </div>
    </div>
</div>
