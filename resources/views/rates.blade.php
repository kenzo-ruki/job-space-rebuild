<x-app-layout>

    <div class="page default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">Smart spending, best listing options</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden">
            <div class="relative w-full">
                <div class="max-w-[75rem] min-h-[800px] mx-auto mb-0 px-24 pb-16">

                    <h2 class="text-center my-6 w-full">Why advertise with us</h2>

                    <!-- Grid -->
                    <div class="mt-12 grid sm:grid-cols-3 gap-12 lg:items-center">
                        <div>
                            <h3 class="">Amazing advertising options. Thousands of CVs available.</h3>
                            <p>We help you find the talent you need quickly and efficiently. Why spend huge dollars on other services if you only need one job posted? Rather browse candidate CVs? You can do it right here with incredible value packages.</p>
                            <p>For the regular recruiters, we have great bulk-buy packages available, meaning you get the best value.</p>
                        </div>
                    @foreach($annualRates as $count => $annualRate)
                        @include('rates.annual', ['count' => $count, 'rate' => $annualRate])
                    @endforeach
                    </div>
                    <!-- End Grid -->
                </div>
            </div>
            <div class="relative w-full stars">
                <div class="max-w-[75rem] min-h-[800px] mx-auto mb-0 px-24 py-16">

                    <h2 class="text-center my-6 text-white w-full">More Advertising Options</h2>
                    <!-- Grid -->
                    <div class="mt-12 grid sm:grid-cols-6 gap-12 lg:items-center">
                    @foreach($packRates as $packCount => $packRate)
                        @include('rates.pack', ['count' => $packCount, 'rate' => $packRate])
                    @endforeach
                    </div>
                    <!-- End Grid -->
                </div>
            </div>
            <div class="relative w-full">
                <div class="max-w-[75rem] min-h-[800px] mx-auto mb-24 px-24 py-16">
                    <h2 class="text-center my-6 text-slate-800 w-full">Single Listing</h2>
                    <!-- Grid -->
                    <div class="mt-12 grid sm:grid-cols-6 gap-12 lg:items-center">
                    @foreach($singleRates as $singleCount => $singleRate)
                        @include('rates.single', ['count' => $singleCount, 'rate' => $singleRate])
                    @endforeach
                    </div>
                    <!-- End Grid -->
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>