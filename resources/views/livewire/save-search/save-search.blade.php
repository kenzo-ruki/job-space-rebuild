<form wire:submit.prevent="save">

    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    <div class="flex w-full justify-end">
        <button type="submit" class="my-3 py-3 px-4 rounded-4xl text-md font-bold text-white bg-cerise-red-500 hover:bg-cerise-red-600">
            <div wire:loading>
                <span class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"></span>
            </div>
            Save Search
        </button>
    </div>
</form>