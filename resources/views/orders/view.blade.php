<?php
$rand_shape = rand(1, 3);
?>
<x-app-layout>

    <div class="page default">
        <!-- Title -->
        <div class="w-full title print:hidden">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">Invoice</h1>
            </div>
        </div>

        <!-- Content -->
        <div class="w-full content relative overflow-hidden">
            @include('shapes.left' . $rand_shape)
            @include('shapes.right' . $rand_shape)
            <div class="relative w-full">
                <div
                    class="relative max-w-[75rem] min-h-[800px] mx-auto z-10 rounded-4xl bg-white px-12 lg:px-24 py-16 mt-16 mb-36 print:mt-0 print:mb-0 print:px-2 print:py-2">
                    <!-- End Title -->
                    @if(session()->has('message'))
                        @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
                    @endif

                    @include('orders.card', ['orderData' => $orderData, 'order' => $order, 'rate' => $rate, $buttons = true])
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>

</x-app-layout>
