
    
    <!-- Card -->
    <form wire:submit="save">

        @if(session()->has('message'))
        @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
        @endif

        @csrf
        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            <input type="text" wire:model="form.first_name" name="first_name" id="first_name" placeholder="First name" class="mb-6 sm:mb-0 rounded-full sm:rounded-l-full sm:rounded-r-none border sm:border-r-0  w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
            <input type="text" wire:model="form.last_name" name="last_name" id="last_name" placeholder="Last name" class="mb-0 rounded-full sm:rounded-r-full sm:rounded-l-none w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
            
        </div>
        @error('form.first_name') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        @error('form.last_name') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        
        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            <input type="email" required wire:model="form.email" name="email" id="email" placeholder="Email address*" class="mb-6 sm:mb-0 rounded-full sm:rounded-l-full sm:rounded-r-none border sm:border-r-0 w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
            <input type="text" wire:model="form.phone" name="phone" id="phone" placeholder="Phone" class="mb-0 rounded-full sm:rounded-r-full sm:rounded-l-none w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
        
        </div>
        @error('form.email') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        @error('form.phone') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            <input type="text" required wire:model="form.subject" name="subject" id="subject" placeholder="Subject*" class="rounded-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
        </div>   
        @error('form.subject') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            <textarea id="message" required wire:model="form.message" name="message" rows="8" cols="40" class="rounded-4xl w-full p-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent"></textarea>
         </div>
         @error('form.message') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

         <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
                <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
                <button type="submit" class="">Get In Touch</button>
            </div>
        </div>

        @if (session()->has('status'))
        <div id="status" class="mt-8 text-center flex">
            <div class="bg-blue-violet-50 border border-blue-violet-100 text-sm text-blue-violet-800 rounded-full py-4 px-6" role="alert">
                <span class="font-bold">{{ session('status') }}</span>
            </div>
        </div>
        @endif
    </form>
    <!-- End Card -->