<?php 

use App\Models\Testimonial;

$testimonials = Testimonial::all();
$rand_shape = rand(1, 3);
?>
<x-app-layout :seo="$seo">

    <div class="page about">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$page->title}}</h1>
            </div>
        </div>
        <!-- End Title -->
    
        <!-- Content -->
        <div class="w-full content relative pt-16 overflow-hidden px-6">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl px-12 lg:px-24 py-16 mb-36">
                <!-- Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-9">
                    @foreach($testimonials as $testimonial)
                    <!-- Card -->
                    <div class="flex h-auto">
                        <div class="flex flex-col bg-white shadow-lg rounded-4xl">
                            <div class="flex-auto p-4 md:p-6">
                                <p class="text-base italic md:text-lg text-slate-800">
                                    {{$testimonial->testimonial}}
                                </p>
                            </div>
                            <div class="p-4 bg-slate-100 rounded-b-4xl md:px-7">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full sm:h-[2.875rem] sm:w-[2.875rem]" src="{{$testimonial->getThumbnail()}}" alt="Testimonial - {{$testimonial->name}}">
                                    </div>
                                    <div class="grow ms-3">
                                        <p class="text-sm sm:text-base font-semibold text-slate-800">
                                            {{$testimonial->name}}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{$testimonial->position}} | {{$testimonial->company}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Content -->
    
    </div>
    
</x-app-layout>