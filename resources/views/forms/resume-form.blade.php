@php
use App\Utilities\RecruiterCredits;
$cvCredits = RecruiterCredits::getCVCredits();
$recruiterView = false;
$inputDisabled = '';
if ($this->form->action == 'none') {
    $recruiterView = true;
    $inputDisabled = 'disabled';
}
@endphp
<!-- Form -->
<form id="resume-form" wire:submit="{{$this->form->action}}">

    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif

    @csrf
    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
        <div class="sm:col-span-12">
            <h1 class="text-2xl font-semibold text-slate-800">
                @if($recruiterView)
                View Resume
                @elseif($this->form->action == 'update')
                Update Your Resume
                @else
                Submit Your Resume
                @endif
            </h1>
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="first_name" class="inline-block text-sm font-medium text-slate-500">
                Title
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <input {{$inputDisabled}} wire:model="form.title" name="title" placeholder="Resume name" type="text" class="py-2 pe-11 h-12 px-6 block w-full border-slate-300 text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.title') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="objective" class="inline-block text-sm font-medium text-slate-500">
                Objective
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <textarea {{$inputDisabled}} name="objective" id="objective" wire:model="form.objective" class="py-2 px-3 min-h-[160px] block w-full border-slate-300 rounded-2xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"></textarea>
             @error('form.objective') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="job_category" class="inline-block text-sm font-medium text-slate-500">
                Job Category
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select {{$inputDisabled}} multiple wire:model="form.job_category" class="rounded-2xl py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Choose</option>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                @endforeach
                </select>
            </div>
            @error('form.job_category') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="job_type" class="inline-block text-sm font-medium text-slate-500">
                Job Type
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select {{$inputDisabled}} multiple wire:model="form.job_type" class="rounded-2xl py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">Choose</option>
                    @foreach($job_types as $job_type)
                        <option value="{{ $job_type['id'] }}">{{ $job_type['type_name'] }}</option>
                    @endforeach
                    <option value="0">All</option>
                </select>
            </div>
            @error('form.job_type') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="country" class="inline-block text-sm font-medium text-slate-500">
                Country
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select {{$inputDisabled}} wire:model="form.country" wire:change="countryChanged($event.target.value)" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="0">Choose</option>
                    <option value="153">New Zealand</option>
                    <option value="13">Australia</option>
                    <option value="0">Others</option>
                </select>
            </div>
            @error('form.country') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="zone" class="inline-block text-sm font-medium text-slate-500">
                Region
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="relative">
                <select {{$inputDisabled}} wire:model="form.zone" class="rounded-full py-3 px-4 pe-9 block w-full border-slate-300 text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Choose</option>
                    @foreach($this->zones as $zone)
                        <option value="{{ $zone['zone_id'] }}" {{ $zone['zone_id'] == $this->form->zone ? 'selected' : '' }}>{{ $zone['zone_name'] }}</option>
                    @endforeach
                    <option value="0">All</option>
                </select>
            </div>
            @error('form.zone') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="sm:col-span-3 mb-3">
            <label for="relocate" class="inline-block text-sm font-medium text-slate-500">
                Willing to relocate?
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div class="flex items-center">
                <label class="font-medium text-sm text-slate-700 me-3">No</label>
                <input {{$inputDisabled}}  {{ 1 == $this->form->relocate ? ' checked ' : '' }} value="{{$this->form->relocate}}" wire:model="form.relocate" type="checkbox" name="relocate" class="relative w-[3.25rem] h-7 p-px bg-slate-400 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-cerise-red-600 checked:bg-none checked:text-cerise-red-600 checked:border-cerise-red-600 focus:checked:border-cerise-red-600 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                <label class="relative font-medium text-sm text-slate-700 ms-3">Yes</label>
            </div>
        </div>

    </div>
    <!-- End Section -->

    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <div class="sm:col-span-12">
            <h2 class="text-lg font-semibold text-slate-800">
                Resume
            </h2>
        </div>

        @if($this->form->resume_file && $cvCredits)
        <div class="sm:col-span-3 mb-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500">
                Current Resume File
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <a href="{{ route('resume.download.recruiter', $this->form->resume) }}" class="text-cerise-red-500">Download Resume</a>
        </div>
        @endif

        @if (!$recruiterView)
        @if ($this->form->resume)
        <div class="sm:col-span-3 mb-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500">
                Current Resume File
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <a href="{{ route('resume.download.jobseeker', $this->form->resume) }}" class="text-cerise-red-500">Download Resume</a>
        </div>
        @endif

        <div class="sm:col-span-3 mb-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500">
                Add/Replace Resume File
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <label for="resume" class="sr-only">
                Choose resume file
            </label>
            <input {{$inputDisabled}} wire:model="form.resume_file" type="file" name="resume" id="resume" class="block w-full border border-slate-300 rounded-full text-sm focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none
                file:bg-transparent file:border-0
                file:bg-slate-200 file:me-4
                file:py-3 file:px-4
                file:cursor-pointer">
            @error('form.resume_file') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        @endif
        <div class="sm:col-span-3 mb-3">
            <div class="inline-block">
                <label for="resume_text" class="inline-block text-sm font-medium text-slate-500">
                    Resume Text
                </label>
            </div>
        </div>
        <div class="sm:col-span-9 mb-3">
            <div wire:ignore>
                <textarea {{$inputDisabled}} wire:model="form.resume_text"
                    wire:model.debounce.999999ms="form.resume_text"
                    wire:key="form.resume_text"
                    class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                    name="resume_text"
                    id="resume_text"></textarea>
            </div>

            @if (!$recruiterView)
            @push('tinymce')
                @include('components.tinymce.instance', ['selector' => '#resume_text', 'wireModel' => 'form.resume_text', 'wordCount' => false])
            @endpush
            @endif

            @error('form.resume_text') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
    </div>
    <!-- End Section -->

     <!-- Section -->
     <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <div class="sm:col-span-12">
            <h2 class="text-lg font-semibold text-slate-800">
                Profile 
            </h2>
        </div>

        @if ($this->form->photo) 
        <div class="sm:col-span-3 mb-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500">
                Current Resume Photo
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <img src="{{ is_object($this->form->photo) && method_exists($this->form->photo, 'temporaryUrl') ? $this->form->photo->temporaryUrl() : asset('/storage/resume_photos/' . $this->form->photo) }}" class="w-1/4 h-auto mx-auto">
        </div>
        @endif

        @if (!$recruiterView)
        <div class="sm:col-span-3 mb-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500">
                Resume Photo
            </label>
        </div>
        <div class="sm:col-span-9 mb-3">
            <label for="resume" class="sr-only">
                Choose file
            </label>
            <input wire:model="form.photo" type="file" name="resume" id="resume" class="block w-full border border-slate-300 rounded-full text-sm focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none
                file:bg-transparent file:border-0
                file:bg-slate-200 file:me-4
                file:py-3 file:px-4
                file:cursor-pointer">
            @error('form.photo') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        @endif

    </div>
    <!-- End Section -->

    @if (!$recruiterView)
    <!-- Section -->
    <div class="py-8 first:pt-0 last:pb-0">
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-600 bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Submit Now</button>
        </div>
    </div>
    @endif

</form>
<!-- End Form -->