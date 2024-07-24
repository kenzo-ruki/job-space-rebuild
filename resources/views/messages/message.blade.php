<div id="dismiss-alert" class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-blue-violet-50 border border-blue-violet-200 text-sm text-blue-violet-800 rounded-full p-4 mb-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
            </svg>
        </div>
        <div class="ms-2">
            <div class="text-sm font-medium">
                {{ $message }}
            </div>
        </div>
        <div class="ps-3 ms-auto">
            <div class="-mx-1 -my-1">
                <button type="button" class="inline-flex bg-blue-violet-50 rounded-full p-1.5 text-blue-violet-500 hover:bg-blue-violet-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2S focus:ring-offset-blue-violet-50 focus:ring-blue-violet-600" data-hs-remove-element="#dismiss-alert">
                    <span class="sr-only">Dismiss</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>