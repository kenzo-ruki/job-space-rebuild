<div>
    <div class="bg-white overflow-hidden">
        <form wire:submit.prevent="search">
            @csrf
            <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <input type="text" wire:model="keywords" placeholder="Keywords" value="{{ $this->keywords ? $this->keywords : '' }}" class="mb-6 sm:mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent"/>
                    </dd>
                </div>
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="category" wire:change="categoryChanged($event.target.value)" class="mb-6 w-full sm:mb-0 rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['slug'] }}" {{ $category['slug'] == $this->category ? 'selected' : '' }}>{{ $category['category_name'] }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="sub_category" class="mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">>
                            <option value="">Sub-category</option>
                            @if(!empty($sub_categories))
                                @foreach($sub_categories as $sub_category)
                                    <option value="{{ $sub_category['slug'] }}" {{ $sub_category['slug'] == $this->sub_category ? 'selected' : '' }}>{{ $sub_category['sub_category_name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </dd>
                </div>
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        @if(!empty($sub_locations) && $this->location)
                            <select wire:model="sub_location" onchange="if (this.value === 'all') { @this.call('loadAllLocations') }" class="mb-6 w-full sm:mb-0 rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                                <option value="{{ $this->location }}" {{ $this->sub_location ? '' : 'selected' }} >{{ $this->location_name }}</option>
                                <option value="all">
                                    &lt; All locations
                                </option>
                                <option value="">Sub-location</option>
                                @foreach($sub_locations as $sub_location)
                                    <option value="{{ $sub_location['slug'] }}" {{ $sub_location['slug'] == $this->location ? 'selected' : '' }}>{{ $sub_location['city_name'] }}</option>
                                @endforeach
                            </select>
                        @else
                            <select wire:model="location" wire:change="locationChanged($event.target.value)" class="mb-6 sm:mb-0 w-full rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                                <option value="">Location</option>
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
                    </dd>
                </div>
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="job_type" class="mb-6 sm:mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Job type</option>
                            @foreach($job_types as $job_type)
                                <option value="{{ $job_type['id'] }}" {{ $job_type['id'] == $this->job_type ? 'selected' : '' }}>{{ $job_type['type_name'] }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="sm:w-full">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <div class="hs-dropdown relative w-full bg-white" data-hs-dropdown-auto-close="inside">
                            <button id="hs-dropdown-item-checkbox" type="button"
                                class="rounded-full w-full inline-flex justify-between hs-dropdown-toggle h-20 pl-8 pr-16 items-center text-lg border border-slate-200 bg-white text-slate-800">
                                Salary
                                <svg class="hs-dropdown-open:rotate-180 size-5  ml-auto" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-white pl-8 pr-16"
                                aria-labelledby="hs-dropdown-item-checkbox">
                                <div class="relative flex items-start px-6 py-3 cursor-pointer">
                                    <div class="flex items-center h-5 mt-1">
                                        <input wire:model="salary_40" value="40" id="salary_40" type="checkbox" class="shrink-0 border-slate-200 rounded-full text-blue-600 focus:ring-blue-500">
                                    </div>
                                    <label for="salary_40" class="ms-3.5"><span class="block text-sm font-semibold text-slate-800">40K</span></label>
                                </div>
                                <div class="relative flex items-start px-6 py-3 cursor-pointer">
                                    <div class="flex items-center h-5 mt-1">
                                        <input wire:model="salary_60" value="60" id="salary_60" type="checkbox" class="shrink-0 border-slate-200 rounded-full text-blue-600 focus:ring-blue-500">
                                    </div>
                                    <label for="salary_60" class="ms-3.5"><span class="block text-sm font-semibold text-slate-800">60K</span></label>
                                </div>
                                <div class="relative flex items-start px-6 py-3 cursor-pointer">
                                    <div class="flex items-center h-5 mt-1">
                                        <input wire:model="salary_80" value="80" id="salary_80" type="checkbox" class="shrink-0 border-slate-200 rounded-full text-blue-600 focus:ring-blue-500">
                                    </div>
                                    <label for="salary_80" class="ms-3.5"><span class="block text-sm font-semibold text-slate-800">80K</span></label>
                                </div>
                                <div class="relative flex items-start px-6 py-3 cursor-pointer">
                                    <div class="flex items-center h-5 mt-1">
                                        <input wire:model="salary_100" value="100" id="salary_100" type="checkbox" class="shrink-0 border-slate-200 rounded-full text-blue-600 focus:ring-blue-500">
                                    </div>
                                    <label for="salary_100" class="ms-3.5"><span class="block text-sm font-semibold text-slate-800">100K+</span></label>
                                </div>
                            </div>
                        </div>
                    </dd>
                </div>
                <div class="sm:w-full">
                    <button wire:click="search"
                        class="mb-0 rounded-full w-full font-bold h-20 px-8 py-4 text-lg text-white placeholder-slate-800 border-1-cerise-red-950 bg-cerise-red-500 inline-flex items-center gap-x-2 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
                        <div wire:loading>
                            <span class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"></span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        Find Jobs
                    </button>
                    @if($this->isset)
                        <a href="" wire:click.prevent="resetSearch" class="w-full block text-cerise-red-500 mt-6 pl-6">Reset Search</a>
                    @endif
                </div>
            </dl>
        </form>
    </div>
</div>
