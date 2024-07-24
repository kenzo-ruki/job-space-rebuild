<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout :seo="$seo">
    <div class="blog default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$post->title}}</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mb-36">

                <div class="group flex flex-col border-b border-slate-200 mb-12 pb-12 grid grid-cols-1 sm:grid-cols-4 gap-12">
                    <div class="col-span-4">
                        <!-- Pagination -->
                        <nav class="flex justify-between items-center gap-x-1">
                            @if($prev)
                            <a href="{{route('post', $prev)}}" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-slate-800 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                <span aria-hidden="true">Previous</span>
                            </a>
                            @endif
                            @if($next)
                            <a href="{{route('post', $next)}}" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-slate-800 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none">
                                <span aria-hidden="true">Next</span>
                                <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                            @endif
                        </nav>
                        <!-- End Pagination -->
                    </div>
                    <div class="col-span-4 aspect-w-16 aspect-h-9">
                        <img src="{{$post->getThumbnail()}}" class="h-auto w-full lg:w-2/3 object-cover rounded-2xl" alt="{{$post->title}}">
                    </div>
                    
                    <div class="body col-span-4 text-lg text-slate-800 space-y-3 md:space-y-5">
                        {!! $post->body !!}
                    </div>
                </div>

            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>