<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]']) }}>
    {{ $slot }}
</button>
