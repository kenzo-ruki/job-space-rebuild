<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout>
    <div class="page default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">Blog</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-24 mb-36">

                @foreach($posts as $count => $post)
                <div class="group flex flex-col border-b border-slate-200 mb-12 pb-12 grid grid-cols-4 gap-12">
                    @if($count == 0)
                    <div class="col-span-4 aspect-w-16 aspect-h-9">
                        <img src="{{$post->getThumbnail()}}" class="h-auto w-full lg:w-2/3 object-cover rounded-4xl" alt="{{$post->title}}">
                    @else
                    <div class="col-span-4 lg:col-span-1 aspect-w-16 aspect-h-9">
                        <img src="{{$post->getThumbnail()}}" class="h-48 w-full lg:w-full sm:w-2/3 object-cover rounded-4xl" alt="{{$post->title}}">
                    @endif
                    </div>
                    @if($count == 0)
                    <div class="col-span-4">
                    @else
                    <div class="col-span-4 lg:col-span-3">
                    @endif
                        <div class="text-xs text-slate-600 pb-3 flex">
                        @foreach($post->categories as $category)
                            <a href="/blog/category/{{$category->slug}}" class="rounded-2xl bg-slate-100 hover:bg-slate-200 transition-bg duration-[400ms] py-2 px-4 mr-3">
                                {{$category->title}}
                            </a>
                        @endforeach
                        </div>
                        <a href="{{route('post', $post)}}">
                            <h3 class="block mt-2 text-xl leading-7 font-semibold text-slate-900">
                                {{$post->title}}
                            </h3>
                            <p class="block mt-3 text-base leading-6 text-slate-500 w-full lg:w-2/3">
                                {{$post->shortBody(30)}}
                            </p>
                        </a>
                        <a class="text-cerise-red-500 hover:text-cerise-red-700 mt-3 inline-flex items-center gap-x-2" href="{{route('post', $post)}}">
                            Read more
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
                {{$posts->links()}}

            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>