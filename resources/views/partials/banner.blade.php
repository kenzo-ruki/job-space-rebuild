<!-- Alert Banner -->
<div id="scam-warning" class="bg-cerise-red-800 @if ($closable == true) hidden @endif">
    <div class="max-w-[75rem] px-6 pt-6 pb-7 px-6 lg:px-8 mx-auto">
        <div class="font-semibold text-white py-1 text-center">
            <span class="flex justify-center items-center w-full text-2xl font-bold">
                JOB OFFER LETTER SCAM
                @if ($closable == true)
                <svg id="close-scam-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer ml-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                @endif
            </span>
            <span class="pt-1 block text-sm w-full">
                Please note, neither Jobspace or Myjobspace (our old trading name) will ever send you a job offer letter on our letterhead.
                If you receive any such letter DO NOT respond!
            </span>
        </div>
    </div>
</div>
<!-- End Alert Banner -->