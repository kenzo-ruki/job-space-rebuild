<!-- Form -->
<form wire:submit="save">
    @csrf
    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
        <div class="sm:col-span-12">
            <h1 class="text-2xl font-semibold text-slate-800">
                @if('save' == $this->form->action)
                Submit your application
                @else
                Review your application
                @endif
            </h1>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
            <label for="first_name" class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                Full name
            </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
            <div class="sm:flex">
                <input wire:model="form.first_name" name="first_name" placeholder="First Name" type="text" class="py-2 px-3 pe-11 block w-full border-slate-300 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-full sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-full text-sm relative focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                <input wire:model="form.last_name" name="last_name"  placeholder="Last Name" type="text" class="py-2 px-3 pe-11 block w-full border-slate-300 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-full sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-full text-sm relative focus:z-10 focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            </div>
            @error('form.first_name') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
            @error('form.last_name') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
            <label for="email" class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                Email
            </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
            <input wire:model="form.email" value="{{ Auth::user()->email }}" name="email" placeholder="Email" type="email" class="py-2 px-3 pe-11 block w-full border-slate-300 shadow-sm text-sm rounded-full focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('form.email') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>
        <!-- End Col -->
    </div>
    <!-- End Section -->

    <!-- Section -->
    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <div class="sm:col-span-12">
            <h2 class="text-lg font-semibold text-slate-800">
                Profile
            </h2>
        </div>

        <div class="sm:col-span-3">
            <label for="resume" class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                Select Resume
            </label>
        </div>
        <div class="sm:col-span-9">
            @if(!empty($resumes))
                <select wire:model="form.resume" name="resume" class="mb-3 py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Select a resume</option>
                    @foreach($resumes as $resume)
                        <option value="{{$resume->id}}">{{$resume->title}}</option>
                    @endforeach
                </select>
            @endif
            @if('save' == $this->form->action)
            <a href="{{route('resume.create')}}" class="inline-block right-0 top-0 rounded-full font-bold px-4 py-3 text-white border-1-cerise-red-600 bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
                Or New Resume
            </a>
            @endif
            @error('form.resume') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
        </div>

        <div class="col-span-12 border-t first:border-transparent border-slate-300 my-3"></div>

        <div class="sm:col-span-3">
            <div class="inline-block">
                <label for="saved_cover_letter" class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                Select Cover Letter
                </label>
            </div>
        </div>
        <div class="sm:col-span-9">
            @if(!empty($coverLetters))
                <select wire:change="coverLetterChanged($event.target.value)" name="saved_cover_letter" class="mb-3 py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Select a Cover Letter</option>
                    @foreach($coverLetters as $coverLetter)
                        <option value="{{$coverLetter->id}}">{{$coverLetter->title}}</option>
                    @endforeach
                </select>
            @endif
            @if('save' == $this->form->action)
            <a href="{{route('cover-letter.create')}}" class="inline-block right-0 top-0 rounded-full font-bold px-4 py-3 text-white border-1-cerise-red-600 bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
                Or New Cover Letter
            </a>
            @endif
        </div>

        <div class="sm:col-span-3">
            <div class="inline-block">
                <label for="cover_text" class="inline-block text-sm font-medium text-slate-500 mt-2.5">
                Cover Letter Text
                </label>
            </div>
        </div>
        <div class="sm:col-span-9">
            <div wire:ignore>
                <textarea wire:model="form.cover_letter"
                    wire:model.debounce.999999ms="form.cover_letter"
                    wire:key="form.cover_letter"
                    class="py-2 px-3 block w-full border-slate-300 rounded-4xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none"
                    name="cover_letter"
                    id="cover_letter"></textarea>
            </div>
            @push('tinymce')
                @include('components.tinymce.instance', ['selector' => '#cover_letter', 'wireModel' => 'form.cover_letter', 'wordCount' => false])
            @endpush

            @error('form.cover_letter') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

            <input wire:model="form.job_id" name="job_id" type="hidden">
        </div>
    </div>
    <!-- End Section -->
    @if(!empty($responses))
        <!-- Section -->
        <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0">
            @foreach ($responses as $index => $response)
                <div class="col-span-12 mb-3">
                    <label for="objective" class="inline-block text-lg font-medium text-slate-500 flex items-center">
                        Question {{ $index + 1 }}: {{ $response['question'] }}
                    </label>
                </div>
                <div class="col-span-12 mb-3">
                    <textarea wire:model="form.responses.{{ $index }}.response" class="py-2 px-3 min-h-[160px] block w-full border-slate-300 rounded-2xl text-sm focus:border-blue-violet-500 focus:ring-blue-violet-500 disabled:opacity-50 disabled:pointer-events-none">
                        {{ (!empty($response['reponse']) ) ? $response['reponse'] : '' ; }}
                    </textarea>
                    @error('form.responses.{{ $index }}.response') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
                </div>
            @endforeach
        </div>
    @endif 

    @if('save' == $this->form->action)
    <!-- Section -->
    <div class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-slate-300">
        <h2 class="text-lg font-semibold text-slate-800 mb-6">
            Submit application
        </h2>
        
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-600 bg-cerise-red-600 hover:bg-cerise-red-700 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Apply Now</button>
        </div>
    </div>
    @endif
</form>
<!-- End Form -->