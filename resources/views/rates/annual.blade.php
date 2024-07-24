
<!-- Card -->
<div class="h-full {{ ( $count === 0 ) ? 'bg-cerise-red-700' : 'bg-white' }} border border-slate-200 shadow-lg rounded-4xl text-center p-8">
    <h4 class="font-bold text-lg {{ ( $count === 0 ) ? 'text-white' : 'text-slate-800' }}">{{$rate->plan_type_name}}</h4>
    <a class="cursor-pointer block rounded-2xl {{ ( $count === 0 ) ?  'text-white' : 'text-cerise-red-700' }} mb-4 inline-flex items-center place-content-center gap-x-1 font-bold"  href="/rates/{{$rate->slug}}">
        Product Details
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right flex-shrink-0 stroke-[2px]" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
        </svg>
    </a>
    <p class="bg-cerise-red-200 text-slate-800 rounded-t-4xl p-8 text-xl font-bold">${{ number_format($rate->fee, 2) }}+GST</p>

    <ul class="bg-white text-md border-x border-slate-200">
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-200">
            <span class="text-slate-800 font-bold">
                Jobs
            </span>
            <span class="text-slate-800">
                {{ ( $rate->number_of_postable_jobs === 2147483647 ) ? 'Unlimited' : $rate->number_of_postable_jobs }}
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-200">
            <span class="text-slate-800 font-bold">
                CVs
            </span>
            <span class="text-slate-800">
                {{ $rate->search_cvs }}
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-200">
            <span class="text-slate-800 font-bold">
                Time Period
            </span>
            <span class="text-slate-800">
                {{ $rate->time_period_months }} Months
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-200">
            <span class="text-slate-800 font-bold">
                Price
            </span>
            <span class="text-slate-800 text-sm">
                ${{ number_format($rate->fee, 2) }}<span class="text-xs">+GST</span>
            </span>
        </li>
    </ul>
    <p class="bg-cerise-red-200 rounded-b-4xl p-8 text-xl font-bold">
        <a class="rounded-full font-bold px-7 py-4 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]" href="/checkout/{{$rate->id}}">
            Buy Now
        </a>
    </p>
</div>
<!-- End Card -->