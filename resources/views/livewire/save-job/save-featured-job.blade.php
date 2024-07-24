<button @if ($saved) wire:click="delete({{ $jobId }})" @else  wire:click="save({{ $jobId }})" @endif class="w-full py-4 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-bl-4xl bg-slate-100 text-slate-800 hover:bg-slate-200 transition-bg duration-[400ms]">
    @if ($saved) Saved @else  Save @endif
</button>