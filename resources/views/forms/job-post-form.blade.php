<!-- Form -->
<form wire:submit="{{$this->form->action}}">
    @csrf

    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif

    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
        <div class="sm:col-span-3 mb-3">
            <label for="title" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Title <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input wire:model="form.title" name="title" placeholder="Title" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.title') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="reference" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Reference <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input wire:model="form.reference" name="reference" placeholder="Reference" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
             @error('form.reference') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="job_category" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Job Category <span class="text-red-500">*</span>
            </label>
        </div>

        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select wire:model="form.job_category" wire:change="categoryChanged($event.target.value)" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Choose</option>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                @endforeach
                </select>
            </div>
            @error('form.job_category') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="job_sub_category" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Job Subcategory <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select wire:model="form.job_sub_category" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Choose</option>
                    <option value="">All</option>
                    @if(!empty($sub_categories))
                        @foreach($sub_categories as $sub_category)
                            <option value="{{ $sub_category['id'] }}">{{ $sub_category['sub_category_name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @error('form.job_sub_category')
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="country" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Country <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select wire:model="form.country" wire:change="countryChanged($event.target.value)" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">All</option>
                    <option value="153">New Zealand</option>
                    <option value="13">Australia</option>
                </select>
            </div>
            @error('form.country') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="zone" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Region <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select wire:model="form.zone" wire:change="zoneChanged($event.target.value)"" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                 @if(!empty($zones))
                    @foreach($this->zones as $zone)
                        <option value="{{ $zone['zone_id'] }}">{{ $zone['zone_name'] }}</option>
                    @endforeach
                @endif
                </select>
            </div>
            @error('form.zone')  
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="city" class="mt-2 inline-block text-sm font-medium text-slate-500">
                City <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select wire:model="form.city" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">All</option>
                @if(!empty($this->cities))
                    @foreach($this->cities as $city)
                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                @endif
                </select>
            </div>
            @error('form.city') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div>
    <!-- End Section -->

    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <div class="sm:col-span-12">
            <h2 class="text-lg font-semibold text-slate-800">
                Details
            </h2>
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="job_type" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Job Type <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select multiple wire:model="form.job_type" class="rounded-2xl py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">All</option>
                    @foreach($job_types as $job_type)
                        <option value="{{ $job_type['id'] }}">{{ $job_type['type_name'] }}</option>
                    @endforeach
                </select>
            </div>
            @error('form.job_type')
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="salary_from" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Salary <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-4 mb-3">
            <input wire:model="form.salary_from" name="salary_from" placeholder="From" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.salary_from') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <span class="mr-3"></span>
        <div class="sm:col-span-4 mb-3">
            <input wire:model="form.salary_to" name="salary_to" placeholder="To" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.salary_to') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="salary_text" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Salary Description
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input wire:model="form.salary_text" name="salary_text" placeholder="Salary Description" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.salary_text') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="start_date" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Start/End Dates <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-4 mb-3">
            <input wire:model="form.start_date" @if ($this->form->action == 'update') disabled @endif id="start_date" value="{{$this->form->start_date}}" name="start_date" placeholder="Start date" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.start_date') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <span class="mr-3"></span>
        <div class="sm:col-span-4 mb-3">
            <input wire:model="form.end_date" @if ($this->form->action == 'update' && !empty($this->form->job->re_adv)) disabled @endif  id="end_date" value="{{$this->form->end_date}}" name="end_date" placeholder="End date" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.end_date') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="sm:col-span-3 mb-3 @if($hideEmail) hidden @endif">
            <label for="job_email" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Application email
            </label>
        </div>
        <div class="sm:col-span-9 mb-3 @if($hideEmail) hidden @endif">
            <input wire:model="form.job_email" name="job_email" placeholder="Send emails to this address" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.job_email') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        
        <div class="sm:col-span-3 mb-3">
            <label for="job_url" class="mt-2 inline-block text-sm font-medium text-slate-500">
                External URL
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input wire:model="form.job_url" wire:change="toggleEmailVisibility" name="job_url" placeholder="External URL" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.job_url') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>

    </div>
    <!-- End Section -->

    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <div class="sm:col-span-12">
            <h2 class="text-lg font-semibold text-slate-800">
                Content 
            </h2>
        </div>

        @if ($this->form->images) 
        <div class="sm:col-span-3 mb-3">
            <label for="images" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Current Images
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            @foreach($this->form->images as $image)
                <img src="{{ is_object($image) && method_exists($image, 'temporaryUrl') ? $image->temporaryUrl() : asset('/storage/' . $image) }}" class="w-1/5 h-auto inline">
            @endforeach
        </div>
        @endif

        <div class="sm:col-span-3 mb-3">
            <label for="images" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Images <span class="text-xs">(five max)</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <label for="images" class="sr-only">
                Choose file
            </label>
            <input multiple wire:model="form.images" type="file" name="images" id="images" class="block w-full border border-slate-300 rounded-full text-sm focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none
                file:bg-transparent file:border-0
                file:bg-slate-200 file:me-4
                file:py-3 file:px-4
                file:cursor-pointer">
            @error('form.images') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="sm:col-span-3 mb-3">
            <label for="title" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Summary (maximum 75 words)
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div wire:ignore>
                <textarea wire:model="form.summary"
                    wire:model.debounce.999999ms="form.summary"
                    wire:key="form.summary"
                    class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                    name="summary"
                    id="summary"></textarea>
            </div>
            @push('tinymce')
                @include('components.tinymce.instance', ['selector' => '#summary', 'wireModel' => 'form.summary', 'wordCount' => 75])
            @endpush
            @error('form.summary') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="sm:col-span-3 mb-3">
            <label for="title" class="mt-2 inline-block text-sm font-medium text-slate-500">
                Description <span class="text-red-500">*</span>
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div wire:ignore>
                <textarea wire:model="form.description"
                    wire:model.debounce.999999ms="form.description"
                    wire:key="form.description"
                    class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                    name="description"
                    id="description"></textarea>
            </div>
            @push('tinymce')
                @include('components.tinymce.instance', ['selector' => '#description', 'wireModel' => 'form.description', 'wordCount' => false])
            @endpush
            @error('form.description') 
                <div class="w-full text-cerise-red-500 mt-2 text-left pl-6">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div> 
    <!-- End Section -->

    <!-- Section -->
    <div class="py-6 first:pt-0 last:pb-0 w-full flex justify-end items-center">
        @if ($this->form?->job)
        <div class="flex items-center rounded-full font-bold h-14 px-8 mr-3 text-white bg-slate-600 hover:bg-slate-700 transition-bg duration-[600ms]">
            <a href="{{ route('job.questions', ['job' => $this->form->job]) }}">Add Questions</a>
        </div>
        @endif
        <div class="flex items-center rounded-full font-bold h-14 px-8 mr-3 text-white bg-slate-600 hover:bg-slate-700 transition-bg duration-[600ms]">
            <button type="button" wire:click="saveDraft">Save Draft</button>
        </div>
        <div class="flex items-center rounded-full font-bold h-14 px-8 text-white bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">{{ $this->form->action == 'update' ? 'Update' : 'Create' }} Now</button>
        </div>
    </div>
</form>
<!-- End Form -->