<?php 
$rand_shape = rand(1, 3);
?>
<x-app-layout>

    <div class="page default">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$rate->plan_type_name}}</h1>
            </div>
        </div>
        <!-- End Title -->

        <!-- Content -->
        <div class="w-full content relative overflow-hidden">
            @include('shapes.left'.$rand_shape)
            @include('shapes.right'.$rand_shape)
            <div class="relative w-full">
                <div class="max-w-[75rem] min-h-[800px] mx-auto mb-0 px-24 pb-16">
                    <!-- Grid -->
                    <div class="mt-12 grid sm:grid-cols-3 gap-12 lg:items-center">
                        @include('rates.annual', ['count' => 0, 'rate' => $rate])
                        <!-- Description -->
                        <div class="col-span-2 h-full bg-white border border-slate-200 shadow-lg rounded-4xl p-8">
                            <h3 class="font-bold text-xl text-slate-800 mb-4">{{$rate->plan_type_name}}</h3>
                            
                            <div class="rate body col-span-4 text-lg text-slate-800 space-y-3 md:space-y-5">
                                {!! $rate->plan_description !!}
                            </div>
                        </div>
                        <!-- End description -->
                    </div>
                    <!-- End Grid -->
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
    
</x-app-layout>