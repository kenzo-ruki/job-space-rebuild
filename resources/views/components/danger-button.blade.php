<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-800 bg-cerise-red-800 hover:bg-cerise-red-900 transition-bg duration-[600ms]']) }}>
    {{ $slot }}
</button>
