<div>
    <!-- Search Form -->
    <!-- End Search Form -->
    <form wire:submit.prevent="search">
        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12">
            @csrf
            <input type="text" wire:model="keywords" placeholder="Enter keywords" value="{{ $this->keywords ? $this->keywords : '' }}" class="mb-6 sm:mb-0 rounded-full sm:rounded-l-full sm:rounded-r-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent"/>
            <select wire:model="category" wire:change="categoryChanged($event.target.value)" class="mb-6 sm:mb-0 rounded-full sm:rounded-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg border-l-0 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category['slug'] }}" {{ $category['slug'] == $this->category ? 'selected' : '' }}>{{ $category['category_name'] }}</option>
                @endforeach
            </select>

            <select wire:model="sub_category" class="mb-0 rounded-full sm:rounded-r-full sm:rounded-l-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg border-l-0 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">>
                <option value="">Select a sub-category</option>
                @if(!empty($sub_categories))
                    @foreach($sub_categories as $sub_category)
                        <option value="{{ $sub_category['slug'] }}" {{ $sub_category['slug'] == $this->sub_category ? 'selected' : '' }}>{{ $sub_category['sub_category_name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="flex flex-col sm:flex-row mb-6 sm:mb-12 relative">
            <select wire:model="job_type" class="mb-6 sm:mb-0 rounded-full sm:rounded-l-full sm:rounded-r-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                <option value="">Select a job type</option>
                @foreach($job_types as $job_type)
                    <option value="{{ $job_type['id'] }}" {{ $job_type['id'] == $this->job_type ? 'selected' : '' }}>{{ $job_type['type_name'] }}</option>
                @endforeach
            </select>

            @if(!empty($sub_locations) && $this->location)
                <select wire:model="sub_location" onchange="if (this.value === 'all') { @this.call('loadAllLocations') }" class="mb-6 sm:mb-0 rounded-full sm:rounded-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg border-l-0 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                    <option value="{{ $this->location }}" {{ $this->sub_location ? '' : 'selected' }} >{{ $this->location_name }}</option>
                    <option value="all">
                        &lt; All locations
                    </option>
                    <option value="">Select a sub-location</option>
                    @foreach($sub_locations as $sub_location)
                        <option value="{{ $sub_location['slug'] }}" {{ $sub_location['slug'] == $this->location ? 'selected' : '' }}>{{ $sub_location['city_name'] }}</option>
                    @endforeach
                </select>
            @else
                <select wire:model="location" wire:change="locationChanged($event.target.value)" class="mb-6 sm:mb-0 rounded-full sm:rounded-none w-full h-20 px-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg border-l-0 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Select a location</option>
                    <option value="new-zealand" {{ 'new-zealand' == $this->location ? 'selected' : '' }}><strong>NZ</strong></option>
                    @foreach($nz_locations as $nz_location)
                        <option value="{{ $nz_location['slug'] }}" {{ $nz_location['slug'] == $this->location ? 'selected' : '' }}>{{ $nz_location['zone_name'] }}</option>
                    @endforeach
                    <option value="australia"  {{ 'australia' == $this->location ? 'selected' : '' }}><strong>All Australia</strong></option>
                    @foreach($au_locations as $au_location)
                        <option value="{{ $au_location['slug'] }}" {{ $au_location['slug'] == $this->location ? 'selected' : '' }}>{{ $au_location['zone_name'] }}</option>
                    @endforeach
                </select>
            @endif

            <button type="submit" class="mb-0 rounded-full sm:rounded-r-full sm:rounded-l-none font-bold w-full h-20 px-8 pr-16 text-lg text-white placeholder-slate-800 border-1-cerise-red-950 bg-cerise-red-500 inline-flex items-center gap-x-2 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
                <div wire:loading>
                    <span class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                Find Jobs
            </button>
            @if($this->isset)
                <a href="" wire:click.prevent="resetSearch" class="absolute -bottom-9 right-3 text-white">Reset Search</a>
            @endif

            @if(!empty($this->errors))
                @foreach($this->errors as $error)
                    <div class="absolute -bottom-9 right-3 text-white"><span class="error">{{ $error }}</span></div>
                @endforeach
            @endif
        </div>
    </form>

</div>