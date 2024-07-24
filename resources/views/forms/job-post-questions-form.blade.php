<div>
    <form wire:submit.prevent="save">
        @csrf
        @if(session()->has('message'))
        @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
        @endif
        <!-- Section -->
        <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
            @foreach ($questions as $index => $question)
                <div class="col-span-12 mb-3">
                    <label for="objective" class="inline-block text-lg font-medium text-slate-500 flex items-center">
                        Question {{ $index + 1 }}
                        
                        <div wire:click="removeQuestion({{ $question['id'] }})" class="cursor-pointer text-red-500 flex inline-flex ml-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </div>
                    </label>
                </div>
                <div class="col-span-12 mb-3">
                    <textarea wire:model="questions.{{ $index }}.question" class="py-2 px-3 min-h-[160px] block w-full border-slate-300 rounded-2xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">{{ $question['question'] }}</textarea>
                    @error('questions.{{ $index }}.question') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
                </div>
            @endforeach

            <div class="col-span-12 mb-3">
                <label for="objective" class="inline-block text-sm font-medium text-slate-500">
                    New Question
                </label>
            </div>
            <div class="col-span-12 mb-3">
                <textarea wire:model="newQuestion" class="py-2 px-3 min-h-[160px] block w-full border-slate-300 rounded-2xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"></textarea>
            </div>

            <!-- Section -->
            <div class="col-span-12 mb-3">
                <div class="py-6 first:pt-0 last:pb-0 w-full flex justify-end items-center">
                    
                    <div class="flex items-center rounded-full font-bold h-14 px-8 mr-3 text-white bg-slate-600 hover:bg-slate-700 transition-bg duration-[600ms]">
                        <a href="{{ route('job.edit', ['job' => $job]) }}">Return to job edit</a>
                    </div>
                    <div class="flex items-center rounded-full font-bold h-14 px-8 text-white bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
                        <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
                        <button type="submit" class="">Add/Update Questions</button>
                    </div>
                </div>
            </div>
    </form>
</div>