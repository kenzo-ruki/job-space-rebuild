<!-- Card -->
<form wire:submit="save">
    @csrf
    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    <input type="hidden" wire:model="job_id">
    <div class="flex flex-col sm:flex-row my-4">
        <input type="text" required wire:model="email" name="email" id="email" placeholder="Email*" class="rounded-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300">
    </div>   
    @error('email') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="flex flex-col sm:flex-row mb-4">
        <select required wire:model="reason" name="reason" id="reason" class="rounded-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300">
            <option value="">Select a reason</option>
            <option value="Fraud">Fraud</option>
            <option value="Spam">Spam</option>
            <option value="Duplicate">Duplicate</option>
            <option value="Offensive">Offensive</option>
            <option value="Other">Other</option>
        </select>
    </div>   
    @error('reason') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="flex flex-col sm:flex-row mb-4">
        <textarea id="message" required wire:model="message" name="message" rows="8" cols="40" class="rounded-4xl w-full p-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300"></textarea>
    </div>
    @error('message') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="flex flex-col sm:flex-row mb-4">
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Report Job</button>
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