<div>
    <div class="bg-white overflow-hidden">
        
        @if ($jobAlert)
        <form wire:submit.prevent="updateJobAlert">
        @else
        <form wire:submit.prevent="createJobAlert">
        @endif
            @if(session()->has('message'))
            @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
            @endif
            @csrf
            <dl>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <input type="text" wire:model="title" placeholder="Title" value="{{ $this->title ? $this->title : '' }}" class="mb-6 sm:mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent"/>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <input type="text" wire:model="keywords" placeholder="Enter keywords" value="{{ $this->keywords ? $this->keywords : '' }}" class="mb-6 sm:mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent"/>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="frequency" class="mb-6 w-full sm:mb-0 rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Select the frequency</option>
                            <option value="daily" {{ "daily" == $this->frequency ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ "weekly" == $this->frequency ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ "monthly" == $this->frequency ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="job_category" class="mb-6 w-full sm:mb-0 rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['slug'] }}" {{ $category['slug'] == $this->job_category ? 'selected' : '' }}>{{ $category['category_name'] }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="location" class="mb-6 sm:mb-0 w-full rounded-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
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
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="job_type" class="mb-6 sm:mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Select a job type</option>
                            @foreach($job_types as $job_type)
                                <option value="{{ $job_type['id'] }}" {{ $job_type['id'] == $this->job_type ? 'selected' : '' }}>{{ $job_type['type_name'] }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dd class="mt-1 text-sm text-slate-900 w-full">
                        <select wire:model="job_salary" class="mb-0 rounded-full w-full h-20 pl-8 pr-16 text-slate-800 placeholder-slate-800 border border-slate-200 text-lg focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">>
                            <option value="">Select a salary</option>
                            <option value="1" {{ "1" == $this->job_salary ? 'selected' : '' }}>1 - 20000</option>
                            <option value="2" {{ "2" == $this->job_salary ? 'selected' : '' }}>20000 - 40000</option>
                            <option value="3" {{ "3" == $this->job_salary ? 'selected' : '' }}>40000 - 60000</option>
                            <option value="4" {{ "4" == $this->job_salary ? 'selected' : '' }}>60000 - 80000</option>
                            <option value="5" {{ "5" == $this->job_salary ? 'selected' : '' }}>80000 - 100000</option>
                            <option value="6" {{ "6" == $this->job_salary ? 'selected' : '' }}>100000 +</option>
                        </select>
                    </dd>
                </div>
            </dl>
            <div class="px-4 py-3 sm:px-6">
                @if ($jobAlert)
                <button type="submit" class="inline-flex items-center rounded-full font-bold px-8 py-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] h-12">
                    <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
                    Update Search/Job Alert
                </button>
                @else
                <button type="submit" class="inline-flex items-center rounded-full font-bold px-8 py-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] h-12">
                    <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
                    Create Search/Job Alert
                </button>
                @endif
            </div>
        </form>
    </div>
</div>
