<!-- Form -->
<form wire:submit="{{$this->form->action}}">
    @csrf

    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    @if("" === $this->form->country_id || null === $this->form->country_id || 0 === $this->form->country_id)
        <p class="text-cerise-red-500 font-bold py-6">Please create your company profile to get started</p>
    @endif
    <!-- Section -->
    @foreach(['first_name', 'last_name', 'position', 'company_name', 'telephone', 'url', 'address1', 'address2'] as $field)
        @if($loop->odd)
            <div class="mt-4 flex flex-col sm:flex-row">
                <div class="w-full sm:w-1/2 mr-0 sm:mr-2">
                    <label for="{{ $field }}" class="inline-block text-sm font-medium text-slate-500">
                        {{ ucwords(str_replace('_', ' ', $field)) }}
                    </label>
                    <input wire:model="form.{{ $field }}" name="{{ $field }}" type="text" class="{{ $field == 'company_name' && $this->form->action == 'update' ? 'disabled' : '' }} mt-1 py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    @error('form.' . $field) <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
                </div>
        @else
                <div class="w-full sm:w-1/2 ml-0 sm:ml-2 mt-2 sm:mt-0">
                    <label for="{{ $field }}" class="inline-block text-sm font-medium text-slate-500">
                        {{ ucwords(str_replace('_', ' ', $field)) }}
                    </label>
                    <input wire:model="form.{{ $field }}" name="{{ $field }}" type="text" class="{{ $field == 'company_name' && $this->form->action == 'update' ? 'disabled' : '' }} mt-1 py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    @error('form.' . $field) <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
                </div>
            </div>
        @endif
    @endforeach

    <div class="mt-4 flex flex-col sm:flex-row">
        <div class="w-full sm:w-1/2 mr-0 sm:mr-2">
            <label for="country" class="inline-block text-sm font-medium text-slate-500">
                Country
            </label>
            <div class="relative">
                <select wire:model="form.country_id" wire:change="countryChanged($event.target.value)" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">Choose</option>
                    <option value="153">New Zealand</option>
                    <option value="13">Australia</option>
                    @foreach($countries as $country)
                        @if( 13 != $country['id'] && 153 != $country['id'] )
                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                        @endif
                    @endforeach
                    <option value="0">All</option>
                </select>
            </div>
            @error('form.country_id') <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        <div class="w-full sm:w-1/2 ml-0 sm:ml-2 mt-2 sm:mt-0">
            <label for="zone" class="inline-block text-sm font-medium text-slate-500">
                Region
            </label>
            <div class="relative">
                <select wire:model="form.state_id" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Choose</option>
                    @foreach($this->zones as $zone)
                        <option value="{{ $zone['zone_id'] }}" {{ $zone['zone_id'] == $this->form->state_id ? 'selected' : '' }}>{{ $zone['zone_name'] }}</option>
                    @endforeach
                    <option value="0">All</option>
                </select>
            </div>
            @error('form.state_id') <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
    </div>
    <div class="mt-4">
        <label for="description" class="w-full block text-sm font-medium text-slate-500">
            Description
        </label>
        <div wire:ignore class="w-full mt-2 block">
            <textarea wire:model="form.description"
                wire:model.debounce.999999ms="form.description"
                wire:key="form.description"
                class="mt-1 py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                name="description"
                id="description"></textarea>
        </div>

        @push('tinymce')
            @include('components.tinymce.instance', ['selector' => '#description', 'wireModel' => 'form.description', 'wordCount' => false])
        @endpush
        @error('form.description') <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
    </div>

    <div class="mt-4">
        @if ($this->form->logo) 
        <div class="w-full">
            <div class="sm:col-span-3 mb-3">
                <label for="logo" class="inline-block text-sm font-medium text-slate-500">
                    Current Company Logo
                </label>
            </div>
            <div class="sm:col-span-9 mb-3">
                <img src="{{ is_object($this->form->logo) && method_exists($this->form->logo, 'temporaryUrl') ? $this->form->logo->temporaryUrl() : asset('/storage/' . $this->form->logo) }}" class="w-1/4 h-auto mx-auto">
            </div>
        </div>
        @endif
        <div wire:ignore class="w-full">
            <label for="logo" class="inline-block text-sm font-medium text-slate-500 mb-2">
                Company Logo
            </label>
            <label for="logo" class="sr-only">
                Choose file
            </label>
            <input wire:model="form.logo" type="file" name="logo" id="logo" class="block w-full border border-slate-300 rounded-full text-sm focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none
                file:bg-transparent file:border-0
                file:bg-slate-200 file:me-4
                file:py-3 file:px-4
                file:cursor-pointer">
            @error('form.logo') <div class="w-full text-cerise-red-500 mt-4 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
    </div>

    <!-- Section -->
    <div class="mt-4 flex flex-col sm:flex-row justify-start">
        <button type="submit" class="inline-flex items-center rounded-full font-bold px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] h-12">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            Update Now
        </button>
    </div>

</form>
<!-- End Form -->