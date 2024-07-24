<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($slides as $count => $slide)
    <div class="flex flex-col bg-white border shadow-sm rounded-4xl">
        <div class="my-4 w-full h-24">
            <img class="w-auto h-full mx-auto"
                src="{{$slide->getThumbnail()}}"
                alt="{{$slide->header}}">
        </div>
        <div class="p-4 md:p-5 mt-2">
            <h3 class="text-lg font-bold text-gray-800 mb-6 text-center">
                {{$slide->header}}
            </h3>
            <p class="w-full text-lg text-center pt-3 mb-2">
                <a class="rounded-full font-bold py-3 px-6 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]" href="{{$slide->link}}">{{$slide->text}}</a>
            </p>
        </div>
    </div>
    @endforeach
</div>