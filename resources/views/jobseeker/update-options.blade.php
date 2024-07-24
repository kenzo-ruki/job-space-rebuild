<form wire:submit.prevent="update">
    @csrf

    <div class="grid grid-cols-12 items-center gap-4">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-right">Hide resume</label>
        <input wire:model="cv_visible" type="checkbox" name="cv_visible" class="col-span-2 mx-auto w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-left">Show resume</label>
    </div>

    <div class="grid grid-cols-12 items-center gap-4 mt-8">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-right">Receive no newsletters</label>
        <input wire:model="newsletter" type="checkbox" name="newsletter" class="col-span-2 mx-auto w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-left">Receive newsletters</label>
    </div>

    <h3 class="border-b border-slate-300 mb-3 pb-3 mt-12 font-light text-center mx-9">Contact Information Visibility</h3>
    <div class="grid grid-cols-12 items-center gap-4 mt-8">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-right">Hide my contact information.</label>
        <input wire:model="contact_details_visibility" type="radio" value="1" name="contact_details_visibility" class="col-span-2 mx-auto w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
    </div>
    
    <div class="grid grid-cols-12 items-center gap-4 mt-8">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-right">Show for applications.</label>
        <input wire:model="contact_details_visibility" type="radio" value="2" name="contact_details_visibility" class="col-span-2 mx-auto w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
    </div>
    
    <div class="grid grid-cols-12 items-center gap-4 mt-8">
        <label class="col-span-5 font-medium text-sm text-slate-700 text-right">Show to all employers.</label>
        <input wire:model="contact_details_visibility" type="radio" value="3" name="contact_details_visibility" class="col-span-2 mx-auto w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
    </div>

    <div class="actions">
        <div class="text-center !py-3 mt-6">
            <x-button type="submit">
                <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
                Update Options
            </x-button>
        </div>
    </div>
    @if ($successMessage)
    <div id="status" class="text-center text-sm text-cerise-red-500">
        <p class="text-cerise-red-500">{{ $successMessage }}</p>
    </div>
    @endif
</form>