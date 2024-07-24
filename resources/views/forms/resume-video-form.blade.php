<!-- Form -->
<form id="resume-video-form" wire:submit="save" class="mt-6">
    @csrf
    <!-- Section --><!-- component -->
    <!-- This is an example component -->
    <div>
        <div class="flex w-full bg-white shadow rounded-4xl overflow-hidden mx-auto mt-12 p-8">
            <div class="flex flex-col m-5">
                <div class="relative">
                    <video class="w-screen"  controls="" autoplay="">
                    </video>
                </div>
                <div>
                    <div class="flex block justify-center space-x-3 mt-3 w-full">
                        <button type="button" id="btn-start-recording" class="py-3 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-cerise-red-500 text-white hover:bg-cerise-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>          
                        </button>
                        <button type="button" id="btn-stop-recording" class="hidden py-3 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-500 text-white hover:bg-blue-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811Z" />
                            </svg>
                        </button>
                        <button type="button" class="hidden py-3 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-500 text-white hover:bg-blue-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 13.5 3 3m0 0 3-3m-3 3v-6m1.06-4.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>           
                        </button>
                        <button id="restart" type="button" class="hidden py-3 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-500 text-white hover:bg-blue-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                        <button id="preview" type="button" class="hidden py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-500 text-white hover:bg-blue-violet-600">
                            Preview         
                        </button>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-500 text-white hover:bg-blue-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span id="videoLength" class="hidden"></span>   
                        </button>
                        <button type="button" id="save-to-disk" class="hidden py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-cerise-red-500 text-white hover:bg-cerise-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            Save video
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Form -->
