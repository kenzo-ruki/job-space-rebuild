<div class="min-h-[80svh] pb-32 flex flex-col sm:justify-center items-center px-6 pt-6 sm:pt-0 relative overflow-hidden">
    <div class="absolute h-[500px] w-[400px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-10 hidden md:block">
        <img class="relative h-[500px] w-auto z-0 bottom-[170px] left-[430px]" src="/img/spaceman_right.svg" alt="wavy background">
    </div>
    <div class="w-full sm:max-w-md mt-12 px-6 py-12 bg-white shadow-md overflow-hidden rounded-4xl">
        {{ $slot }}
    </div>
</div>
