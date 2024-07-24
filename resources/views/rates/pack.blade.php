
<!-- Card -->
<div class="col-span-2 {{ ( $count === 3 ) ? 'col-start-2' : '' }} h-full border border-slate-800 bg-slate-900 shadow-lg rounded-4xl text-center p-8 text-white">
    <h4 class="font-bold text-lg">{{$rate->plan_type_name}}</h4>
    <a class="block rounded-2xl mb-4 inline-flex items-center place-content-center gap-x-1 font-bold" href="/rates/{{$rate->slug}}">
        Product Details
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right flex-shrink-0 stroke-[2px]" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
        </svg>
    </a>
    <p class="bg-slate-800 text-white rounded-t-4xl p-8 text-xl font-bold">${{ number_format($rate->fee, 2) }}+GST</p>

    <ul class="bg-slate-700 text-md border-x border-slate-600">
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-600">
            <span class="text-white font-bold">
                Jobs
            </span>
            <span class="text-white">
                {{ ( $rate->number_of_postable_jobs === -1 ) ? 'Unlimited' : $rate->number_of_postable_jobs }}
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-600">
            <span class="text-white font-bold">
                CVs
            </span>
            <span class="text-white">
                {{ $rate->search_cvs }}
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-600">
            <span class="text-white font-bold">
                Time Period
            </span>
            <span class="text-white">
                {{ $rate->time_period_months }} Months
            </span>
        </li>
        <li class="grid grid-cols-2 gap-4 place-content-around py-2 px-8 text-left border-t border-slate-600">
            <span class="text-white font-bold">
                Price
            </span>
            <span class="text-white text-sm">
                ${{ number_format($rate->fee, 2) }}<span class="text-xs">+GST</span>
            </span>
        </li>
    </ul>
    <p class="bg-slate-800 rounded-b-4xl p-8 text-xl font-bold">
        <a class="rounded-full font-bold px-7 py-4 text-white border-1-blue-violet-500 bg-blue-violet-500 hover:bg-blue-violet-600 transition-bg duration-[600ms]" href="/checkout/{{$rate->id}}">
            Buy Now
        </a>
    </p>
</div>
<!-- End Card -->