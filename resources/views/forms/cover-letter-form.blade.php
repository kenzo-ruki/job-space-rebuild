<!-- Form -->
<form id="letter-form" wire:submit="{{$this->action}}">

    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif

    @csrf
    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
        <div class="sm:col-span-12">
            <h1 class="text-2xl font-semibold text-slate-800">
                @if($this->action == 'update')
                Update Your Letter
                @else
                Submit Your Letter
                @endif
            </h1>
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="first_name" class="inline-block text-sm font-medium text-slate-500">
                Title
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input wire:model="title" name="title" placeholder="Letter name" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('title') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        <div class="sm:col-span-3 mb-3">
            <div class="inline-block">
                <label for="text" class="inline-block text-sm font-medium text-slate-500">
                    Letter Text
                </label>
            </div>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div wire:ignore>
                <textarea wire:model="text"
                    wire:model.debounce.999999ms="text"
                    wire:key="text"
                    class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                    name="text"
                    id="text"></textarea>
            </div>
            @push('tinymce')
                @include('components.tinymce.instance', ['selector' => '#text', 'wireModel' => 'text', 'wordCount' => false])
            @endpush

            @error('text') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
    </div>
    <!-- End Section -->
    <!-- Section -->
    <div class="py-8 first:pt-0 last:pb-0">
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-600 bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Submit Now</button>
        </div>
    </div>

</form>
<!-- End Form -->