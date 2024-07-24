<?php
$decimalFee = round($rate->fee, 2);
$gst = round($rate->fee * 0.15, 2);
$fullFee = round($rate->fee * 1.15, 2);
?>
<div class="body text-lg text-slate-800 space-y-3 md:space-y-5">
    <div class="relative flex flex-col bg-white shadow-lg rounded-4xl pointer-events-auto">
        <div class="print:hidden relative overflow-hidden min-h-32 bg-blue-violet-900 text-center rounded-t-4xl">

            <!-- SVG Background Element -->
            <figure class="absolute inset-x-0 bottom-0 -mb-px">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    viewBox="0 0 1920 100.1">
                    <path fill="currentColor" class="fill-white"
                        d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                </svg>
            </figure>
            <!-- End SVG Background Element -->
        </div>

        <div class="print:hidden relative z-10 -mt-12">
            <!-- Icon -->
            <span
                class="mx-auto flex justify-center items-center size-[62px] rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm">
                <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                    <path
                        d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                </svg>
            </span>
            <!-- End Icon -->
        </div>

        <!-- Body -->
        <div class="p-4 sm:p-7 overflow-y-auto">
            <div class="print:hidden text-center">
                <h3 class="text-lg font-semibold text-slate-800">
                    Subscription Invoice
                </h3>
            </div>
            <!-- Invoice -->
            <div class="max-w-[75rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10 print:my-2">
                <!-- Grid -->
                <div
                    class="mb-5 pb-5 flex justify-between items-center border-b border-slate-200">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-800">Invoice
                        </h2>
                    </div>
                    <!-- Col -->

                    @if ($buttons)
                    <div class="print:hidden inline-flex gap-x-2">
                        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-full border font-medium bg-white text-slate-700 shadow-sm align-middle hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-violet-600 transition-all text-sm"
                            href="{{ route('pdf.invoice', ['order' => $order->orders_id]) }}">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                            Invoice PDF
                        </a>
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-violet-900 text-white hover:bg-blue-violet-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="#" onclick="window.print();">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path
                                    d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>
                            Print
                        </a>
                    </div>
                    <!-- Col -->
                    @endif
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <div class="grid space-y-3">
                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-36 max-w-[200px] text-slate-500">
                                    Billed to:
                                </dt>
                                <dd class="text-slate-800">
                                    <a class="inline-flex items-center gap-x-1.5 text-blue-violet-600 decoration-2 hover:underline font-medium"
                                        href="mailto:{{ $orderData['personal_details']['email'] }}">
                                        {{ $orderData['personal_details']['email'] }}
                                    </a>
                                </dd>
                            </dl>

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-36 max-w-[200px] text-slate-500">
                                    Billing details:
                                </dt>
                                <dd class="font-medium text-slate-800">
                                    <span class="block font-semibold">{{ $orderData['personal_details']['name'] }}</span>
                                    <address class="not-italic font-normal">
                                        @foreach ($orderData['billing_details'] as $value)
                                            @if ($value)
                                                {{ $value }}<br>
                                            @endif
                                        @endforeach
                                    </address>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Col -->

                    <div>
                        <div class="grid space-y-3">

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-36 max-w-[200px] text-slate-500">
                                    Currency:
                                </dt>
                                <dd class="font-medium text-slate-800">
                                    NZD - NZ Dollar
                                </dd>
                            </dl>

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-36 max-w-[200px] text-slate-500">
                                    Invoice Date:
                                </dt>
                                <dd class="font-medium text-slate-800">
                                    {{ $orderData['date_purchased'] }}
                                </dd>
                            </dl>

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-36 max-w-[200px] text-slate-500">
                                    Billing method:
                                </dt>
                                <dd class="font-medium text-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        width="100" height="37" viewBox="0 0 170 48">
                                        <g clip-path="url(#a)">
                                            <path fill="#003087"
                                                d="M62.56 28.672a10.111 10.111 0 0 0 9.983-8.56c.78-4.967-3.101-9.303-8.6-9.303H55.08a.689.689 0 0 0-.69.585l-3.95 25.072a.643.643 0 0 0 .634.742h4.69a.689.689 0 0 0 .688-.585l1.162-7.365a.689.689 0 0 1 .689-.586h4.257Zm3.925-8.786c-.29 1.836-1.709 3.189-4.425 3.189h-3.474l1.053-6.68h3.411c2.81.006 3.723 1.663 3.435 3.496v-.005Zm26.378-1.18H88.41a.69.69 0 0 0-.69.585l-.144.924s-3.457-3.775-9.575-1.225c-3.51 1.461-5.194 4.48-5.91 6.69 0 0-2.277 6.718 2.87 10.417 0 0 4.771 3.556 10.145-.22l-.093.589a.642.642 0 0 0 .634.742h4.451a.689.689 0 0 0 .69-.585l2.708-17.175a.643.643 0 0 0-.634-.742Zm-6.547 9.492a4.996 4.996 0 0 1-4.996 4.276 4.513 4.513 0 0 1-1.397-.205c-1.92-.616-3.015-2.462-2.7-4.462a4.996 4.996 0 0 1 5.014-4.277c.474-.005.946.065 1.398.206 1.913.614 3.001 2.46 2.686 4.462h-.005Z" />
                                            <path fill="#0070E0"
                                                d="M126.672 28.672a10.115 10.115 0 0 0 9.992-8.56c.779-4.967-3.101-9.303-8.602-9.303h-8.86a.69.69 0 0 0-.689.585l-3.962 25.079a.637.637 0 0 0 .365.683.64.64 0 0 0 .269.06h4.691a.69.69 0 0 0 .689-.586l1.163-7.365a.688.688 0 0 1 .689-.586l4.255-.007Zm3.925-8.786c-.29 1.836-1.709 3.189-4.426 3.189h-3.473l1.054-6.68h3.411c2.808.006 3.723 1.663 3.434 3.496v-.005Zm26.377-1.18h-4.448a.69.69 0 0 0-.689.585l-.146.924s-3.456-3.775-9.574-1.225c-3.509 1.461-5.194 4.48-5.911 6.69 0 0-2.276 6.718 2.87 10.417 0 0 4.772 3.556 10.146-.22l-.093.589a.637.637 0 0 0 .365.683c.084.04.176.06.269.06h4.451a.686.686 0 0 0 .689-.586l2.709-17.175a.657.657 0 0 0-.148-.518.632.632 0 0 0-.49-.224Zm-6.546 9.492a4.986 4.986 0 0 1-4.996 4.276 4.513 4.513 0 0 1-1.399-.205c-1.921-.616-3.017-2.462-2.702-4.462a4.996 4.996 0 0 1 4.996-4.277c.475-.005.947.064 1.399.206 1.933.614 3.024 2.46 2.707 4.462h-.005Z" />
                                            <path fill="#003087"
                                                d="m109.205 19.131-5.367 9.059-2.723-8.992a.69.69 0 0 0-.664-.492h-4.842a.516.516 0 0 0-.496.689l4.88 15.146-4.413 7.138a.517.517 0 0 0 .442.794h5.217a.858.858 0 0 0 .741-.418l13.632-22.552a.516.516 0 0 0-.446-.789h-5.215a.858.858 0 0 0-.746.417Z" />
                                            <path fill="#0070E0"
                                                d="m161.982 11.387-3.962 25.079a.637.637 0 0 0 .365.683c.084.04.176.06.269.06h4.689a.688.688 0 0 0 .689-.586l3.963-25.079a.637.637 0 0 0-.146-.517.645.645 0 0 0-.488-.225h-4.69a.69.69 0 0 0-.689.585Z" />
                                            <path fill="#001C64"
                                                d="M37.146 22.26c-1.006 5.735-5.685 10.07-11.825 10.07h-3.898c-.795 0-1.596.736-1.723 1.55l-1.707 10.835c-.099.617-.388.822-1.013.822h-6.27c-.634 0-.784-.212-.689-.837l.72-7.493-7.526-.389c-.633 0-.862-.345-.772-.977l5.135-32.56c.099-.617.483-.882 1.106-.882h13.023c6.269 0 10.235 4.22 10.72 9.692 3.73 2.52 5.474 5.873 4.72 10.168Z" />
                                            <path fill="#0070E0"
                                                d="m12.649 25.075-1.907 12.133-1.206 7.612a1.034 1.034 0 0 0 1.016 1.19h6.622a1.27 1.27 0 0 0 1.253-1.072l1.743-11.06a1.27 1.27 0 0 1 1.253-1.071h3.898A12.46 12.46 0 0 0 37.617 22.26c.675-4.307-1.492-8.228-5.201-10.165a9.96 9.96 0 0 1-.12 1.37 12.461 12.461 0 0 1-12.295 10.54h-6.1a1.268 1.268 0 0 0-1.252 1.07Z" />
                                            <path fill="#003087"
                                                d="M10.741 37.208H3.03a1.035 1.035 0 0 1-1.018-1.192L7.208 3.072A1.268 1.268 0 0 1 8.46 2H21.7c6.269 0 10.827 4.562 10.72 10.089a11.567 11.567 0 0 0-5.399-1.287H15.983a1.27 1.27 0 0 0-1.254 1.071l-2.08 13.202-1.908 12.133Z" />
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h166v44.01H0z"
                                                    transform="translate(2 2)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->

                <!-- Table -->
                <div
                    class="mt-6 border border-slate-200 p-4 rounded-lg space-y-4 print:mt-2">
                    <div class="hidden sm:grid sm:grid-cols-5">
                        <div class="sm:col-span-2 text-xs font-medium text-slate-500 uppercase">Item
                        </div>
                        <div class="text-start text-xs font-medium text-slate-500 uppercase">Qty
                        </div>
                        <div class="text-start text-xs font-medium text-slate-500 uppercase">Rate
                        </div>
                        <div class="text-end text-xs font-medium text-slate-500 uppercase">Amount
                        </div>
                    </div>

                    <div class="hidden sm:block border-b border-slate-200">
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-slate-500 uppercase">Item
                            </h5>
                            <p class="font-medium text-slate-800">
                                {{ $rate->plan_type_name }}
                            </p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-slate-500 uppercase">Qty
                            </h5>
                            <p class="text-slate-800">1</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-slate-500 uppercase">Rate
                            </h5>
                            <p class="text-slate-800">${{ $decimalFee }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-slate-500 uppercase">Subtotal</h5>
                            <p class="sm:text-end text-slate-800">${{ $decimalFee }}</p>
                        </div>
                    </div>
                </div>
                <!-- End Table -->

                <!-- Flex -->
                <div class="mt-8 flex sm:justify-end print:mt-2">
                    <div class="w-full max-w-2xl sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                <dt class="col-span-3 text-slate-500">Subtotal:</dt>
                                <dd
                                    class="col-span-2 font-medium text-slate-800">
                                    ${{ $decimalFee }}</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                <dt class="col-span-3 text-slate-500">Total:</dt>
                                <dd
                                    class="col-span-2 font-medium text-slate-800">
                                    ${{ $fullFee }}</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                <dt class="col-span-3 text-slate-500">Tax:</dt>
                                <dd
                                    class="col-span-2 font-medium text-slate-800">
                                    ${{ $gst }}</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                <dt class="col-span-3 text-slate-500">Amount paid:</dt>
                                <dd
                                    class="col-span-2 font-medium text-slate-800">
                                    ${{ $fullFee }}</dd>
                            </dl>
                        </div>
                        <!-- End Grid -->
                    </div>
                </div>
                <!-- End Flex -->
            </div>
            <!-- End Invoice -->
            <div class="print:hidden mt-5 sm:mt-10">
                <p class="text-sm text-slate-500">If you have any questions, please contact us at
                    <a class="inline-flex items-center gap-x-1.5 text-blue-violet-600 decoration-2 hover:underline font-medium"
                        href="mailto:site@jobspace.co.nz">site@jobspace.co.nz</a> or call at <a
                        class="inline-flex items-center gap-x-1.5 text-blue-violet-600 decoration-2 hover:underline font-medium"
                        href="tel:0800 486 329">0800 486 329</a></p>
            </div>
        </div>
        <!-- End Body -->
    </div>
</div>