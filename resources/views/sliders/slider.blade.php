<div data-hs-carousel='{
    "loadingClasses": "opacity-0"
  }' class="relative">
    <div class="hs-carousel relative overflow-hidden w-full min-h-[500px] bg-white rounded-lg">
        <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
            
            <!-- Items -->
            @foreach($slides as $count => $slide)
            <div class="hs-carousel-slide">
                <div class="relative flex justify-center h-full bg-slate-100">
                    <img src="{{$slide->getThumbnail()}}" class="mx-auto w-auto h-[200px] sm:h-[300px]" alt="{{$slide->header}}" />
                    <div class="absolute h-full w-full bg-slate-900 bg-opacity-40 w-full h-full"></div>
                    <div class="absolute h-full w-full flex items-center justify-center text-white opacity-90">
                        <div class="m-auto">
                            <h5 class="text-xl text-center">{{$slide->header}}</h5>
                            <p class="text-center">{{$slide->text}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-75 absolute bottom-0 left-0 top-0 z-[1] flex w-[5%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-75 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none">
        <span class="inline-block h-8 w-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
          </span>
        <span class="sr-only">Previous</span>
    </button>
    <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-75 absolute bottom-0 right-0 top-0 z-[1] flex w-[5%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-75 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none">
        <span class="sr-only">Next</span>
        <span class="inline-block h-8 w-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
          </span>
    </button>

    <div class="hs-carousel-pagination absolute inset-x-0 bottom-2 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0">
        <!-- Pagination -->
        @foreach($slides as $count => $slide)
        <span class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-75 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"></span>
        @endforeach
    </div>
</div>