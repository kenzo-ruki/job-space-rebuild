<div id="dismiss-alert" class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-cerise-red-50 border border-cerise-red-200 text-sm text-cerise-red-800 rounded-full p-4 mb-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
            </svg>
        </div>
        <div class="ms-2">
            <div class="text-sm font-medium">
                {{ $message }}
            </div>
        </div>
        <div class="ps-3 ms-auto">
            <div class="-mx-1 -my-1">
                <button type="button" class="inline-flex bg-cerise-red-50 rounded-full p-1.5 text-cerise-red-500 hover:bg-cerise-red-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2S focus:ring-offset-cerise-red-50 focus:ring-cerise-red-600" data-hs-remove-element="#dismiss-alert">
                    <span class="sr-only">Dismiss</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>