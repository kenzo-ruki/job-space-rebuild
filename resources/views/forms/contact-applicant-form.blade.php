

<!-- Card -->
<form wire:submit="save">
    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    @csrf
    <input type="hidden" wire:model="application_id">
    <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
        <input type="text" required wire:model="contact_applicant_subject" name="contact_applicant_subject" id="contact_applicant_subject" placeholder="Subject*" class="rounded-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
    </div>   
    @error('contact_applicant_subject') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
        
        <div class="flex-grow" wire:ignore>
            <textarea wire:model="contact_applicant_message"
                wire:model.debounce.999999ms="contact_applicant_message"
                wire:key="contact_applicant_message"
                class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                name="contact_applicant_message"
                id="contact_applicant_message"></textarea>
        </div>
        @push('tinymce')
            @include('components.tinymce.instance', ['selector' => '#contact_applicant_message', 'wireModel' => 'contact_applicant_message', 'wordCount' => false])
        @endpush
        @error('contact_applicant_message') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
    </div>

    <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
        <input wire:model="email_attachment" type="file" class="block w-full border border-slate-300 rounded-full text-sm focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none
            file:bg-transparent file:border-0
            file:bg-slate-200 file:me-4
            file:py-3 file:px-4
            file:cursor-pointer">
        @error('email_attachment') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
    </div>

    <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Contact Applicant</button>
        </div>
    </div>
</form>
<!-- End Card -->