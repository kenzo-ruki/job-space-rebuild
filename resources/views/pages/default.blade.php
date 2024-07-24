<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout :seo="$seo">

    <div class="page default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$page->title}}</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden z-1">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mb-36">
                <div class="body text-lg text-slate-800 space-y-3 md:space-y-5">
                    {!! $page->body !!}
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>