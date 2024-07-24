<div class="mb-6">
    <form wire:submit="search">
        @csrf

        <div class="mt-4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2 mr-0 sm:mr-2">
                <div class="relative">
                    <x-label for="category" value="Category" />
                    <select wire:model="form.job_category" class="mt-2 rounded-full pt-3 pb-4 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option value="">Choose</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                    @endforeach
                    </select>
                </div>
                @error('form.job_category') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            </div>
            <div class="w-full sm:w-1/2 mr-0 sm:ml-2 mt-2 sm:mt-0">
                <div class="relative">
                    <x-label for="job_type" value="Job Type" />
                    <select wire:model="form.job_type" class="mt-2 rounded-full pt-3 pb-4 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option value="">Choose</option>
                    @foreach($job_types as $job_type)
                        <option value="{{ $job_type['id'] }}">{{ $job_type['type_name'] }}</option>
                    @endforeach
                    </select>
                </div>
                @error('form.job_type') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            </div>
        </div>

        <div class="mt-4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2 mr-0 sm:mr-2">
                <div class="relative">
                    <x-label for="country" value="Country" />
                    <select wire:model="form.country" wire:change="countryChanged($event.target.value)" class="mt-2 rounded-full pt-3 pb-4 px-4 pe-9 block w-full mt-2 border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option value="0">Choose</option>
                        <option value="153">New Zealand</option>
                        <option value="13">Australia</option>
                        <option value="0">All</option>
                    </select>
                </div>
                @error('form.country') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            </div>
            <div class="w-full sm:w-1/2 mr-0 sm:ml-2 mt-2 sm:mt-0">
                <x-label for="region" value="Region" />
                <div class="relative">
                    <select wire:model="form.zone" class="rounded-full pt-3 pb-4 px-4 pe-9 block w-full mt-2 border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option value="">Choose</option>
                        @foreach($zones as $zone)
                            <option value="{{ $zone['zone_id'] }}" {{ $zone['zone_id'] == $this->form->zone ? 'selected' : '' }}>{{ $zone['zone_name'] }}</option>
                        @endforeach
                        <option value="0">All</option>
                    </select>
                </div>
                @error('form.zone') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            </div>
        </div>
        <div class="mt-4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2 mr-0 sm:ml-2 mt-2 sm:mt-0">
                <div class="relative">
                    <x-label for="keywords" value="Keywords" />
                    <input wire:model="form.keywords" type="text" class="mt-2 rounded-full pt-3 pb-4 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none" />
                </div>
                @error('form.keywords') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            </div>
            <div class="w-full sm:w-1/2 mr-0 sm:ml-2 mt-7">
                <button type="submit" class="inline-flex items-center rounded-full font-bold px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] mx-auto h-11">
                    Search
                </button>
            </div>
        </div>
    </form>
</div>