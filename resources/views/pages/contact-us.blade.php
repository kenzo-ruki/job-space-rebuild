<x-app-layout :seo="$seo">

    <div class="page contact">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$page->title}}</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            <img class="absolute -bottom-[65px] -left-[35px] h-[400px] w-auto z-1" src="{{ asset('/img/left_planets1.svg') }}" alt="wavy background">
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto mb-0 z-10 rounded-t-2xl bg-white px-6 md:px-12 lg:px-20 py-16">
                <div class="body text-lg text-slate-800 space-y-3 md:space-y-5">
                    {!! $page->body !!}
                </div>

            </div>
        </div>
        <!-- End Content -->

        <!-- Contact form -->
        <div class="form bg-gradient-to-b from-blue-violet-400 to-blue-violet-300 relative overflow-hidden z-1">
            <img class="absolute top-[150px] -right-[140px] h-[450px] w-auto z-1" src="{{ asset('/img/right_planets1.svg') }}" alt="wavy background">
            <div class="relative max-w-[75rem] min-h-[600px] mx-auto px-6 md:px-12 lg:px-20 z-10">
                <div class="font-semibold text-slate-700 py-1 text-center">
                    <!-- Hero -->
                    <div class="relative max-w-[75rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-24 mx-auto z-10">
                        <img class="absolute left-32 -top-2 w-[600px] h-auto hidden md:block" src="{{ asset('/img/big_arrow.png') }}" alt="big arrow">
                        <!-- Grid -->
                        <div class="grid items-center md:grid-cols-3 gap-20 lg:gap-32">
                            <div>
                                <!-- Title -->
                                <div class="mt-4 md:mb-12 max-w-2xl">
                                    <h1 class="mb-4 font-semibold text-slate-800 text-4xl lg:text-5xl">
                                        Get in touch
                                    </h1>
                                    <p class="text-slate-600">
                                        Would you like to get in touch? Send us an email and we'll respond shortly.
                                    </p>
                                </div>
                                <!-- End Title -->
                            </div>
                            <!-- End Col -->
                    
                            <div class="col-span-2">
                                <div class="w-full">
                                    <!-- Card -->
                                    <div class="p-4 sm:p-7 flex flex-col bg-white rounded-4xl shadow-lg">
                                        <div class="text-center">
                                            <h1 class="block text-2xl font-bold text-slate-800">Get in Touch</h1>
                                        </div>
                        
                                        <div class="mt-5">
                                            @livewire('forms.contact-form')
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            <!-- End Form -->
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Grid -->
                    </div>
                    <!-- End Hero -->
                </div>
            </div>
        </div>
        <!-- End Contact Form -->
    </div>

</x-app-layout>