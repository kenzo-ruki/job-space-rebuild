
<!-- Card -->
<form wire:submit="save" class="w-full">
    
    @if(session()->has('message'))
    @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    @csrf
    <div class="w-full flex">
        <input type="email" required wire:model="form.email" name="email" id="email" placeholder="Email address*" class="rounded-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent">
    </div>
    @error('form.email') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="w-full sm:flex mt-8">
        <select required wire:model="form.frequency" name="frequency" id="frequency" class="rounded-full sm:rounded-full mb-6 sm:mb-0 w-full w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent text-sm focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
            <option selected="">Frequency*</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
    @error('form.frequency') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="w-full sm:flex mt-8">
        <select wire:model="form.occupation" name="occupation" id="occupation" class="rounded-full sm:rounded-l-full sm:rounded-r-none mb-6 sm:mb-0 w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent text-sm focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
            <option value="" selected="">Occupation</option>
            <option value="43">Accounting</option>
            <option value="44">Agriculture, Fishing &amp; Forestry</option>
            <option value="45">Animal Welfare</option>
            <option value="46">Architecture &amp; Design</option>
            <option value="47">Arts &amp; Entertainment</option>
            <option value="48">Automotive</option>
            <option value="49">Banking, Finance &amp; Insurance</option>
            <option value="50">Business Opportunities</option>
            <option value="51">Construction</option>
            <option value="52">Customer Service</option>
            <option value="53">Driving</option>
            <option value="54">Education</option>
            <option value="55">Energy</option>
            <option value="56">Engineering</option>
            <option value="57">Executive &amp; General Management</option>
            <option value="58">Fashion &amp; Beauty</option>
            <option value="59">Government &amp; Council</option>
            <option value="60">Haurapa Mahi- Maori Language Job Search</option>
            <option value="61">Healthcare</option>
            <option value="62">Hospitality &amp; Tourism</option>
            <option value="63">HR &amp; Recruitment</option>
            <option value="64">IT</option>
            <option value="65">Legal</option>
            <option value="66">Manufacturing &amp; Operations</option>
            <option value="67">Marketing, Media &amp; Communications</option>
            <option value="68">Office &amp; Administration</option>
            <option value="69">Property</option>
            <option value="70">Retail</option>
            <option value="71">Sales</option>
            <option value="72">Science &amp; Technology</option>
            <option value="73">Tourism &amp; Leisure</option>
            <option value="74">Trades &amp; Services</option>
            <option value="75">Transport &amp; logistics</option>
            <option value="76">Volunteers</option>
            <option value="77">Xrated- R18</option>
        </select>
        <select wire:model="form.location" name="location" id="location"  class="rounded-full sm:rounded-r-full sm:rounded-l-none sm:border-l-0 w-full h-12 px-6 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent text-sm focus:border-slate-400 focus:ring-white disabled:opacity-50 disabled:pointer-events-none">
            <option selected="">Location</option>
            <option value="region-138">Northland</option>
            <option value="region-139">Auckland</option>
            <option value="region-140">Waikato</option>
            <option value="region-141">Bay of Plenty</option>
            <option value="region-142">Gisborne</option>
            <option value="region-143">Hawke's Bay</option>
            <option value="region-144">Taranaki</option>
            <option value="region-145">Manawatu / Wanganui</option>
            <option value="region-146">Wellington</option>
            <option value="region-147">Nelson / Tasman</option>
            <option value="region-148">Marlborough</option>
            <option value="region-149">West Coast</option>
            <option value="region-150">Canterbury</option>
            <option value="region-151">Chatham Islands</option>
            <option value="region-152">Otago</option>
            <option value="region-153">Southland</option>
            <option value="region-154">Other - Overseas</option>
            <option value="country-13">Australia</option>
        </select>
    </div>
    @error('form.occupation') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror
    @error('form.location') <div class="w-full text-cerise-red-500 mt-2 text-left pl-6"><span class="error">{{ $message }}</span></div> @enderror

    <div class="w-full flex mt-8">
        <div class="mx-auto inline-flex items-center rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]">
            <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            <button type="submit" class="">Get Notifications</button>
        </div>
    </div>
</form>
<!-- End Card -->