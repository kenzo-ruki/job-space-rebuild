@php
$decimalFee = round($rate->fee, 2);
$gst = round($rate->fee * 0.15, 2);
$fullFee = round($rate->fee * 1.15, 2);
@endphp
<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
<div class="table">
    <table cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="font-weight: bold; font-size: 24px">
                Subscription Invoice
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">
                Date: {{ $orderData['date_purchased'] }}<br />
                Currency: NZD - NZ Dollar<br />
                Billing method: PayPal
            </td>
        </tr>
        <tr style="height: 50px;">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 18px">
                {{ $orderData['personal_details']['name'] }}
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">
                @foreach ($orderData['billing_details'] as $value)
                    @if ($value)
                        {{ $value }}<br>
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="height: 50px;">
            <td colspan="2"></td>
        </tr>
        <tr style="background-color: #eeeeee;">
            <td style="font-weight: bold; padding-left: 10px;" width="50%">Item</td>
            <td style="font-weight: bold;" width="10%">Qty</td>
            <td style="font-weight: bold;" width="20%">Rate</td>
            <td style="font-weight: bold;" width="20%">Amount</td>
        </tr>
        <tr>
            <td style="padding-left: 10px;" width="50%">{{ $rate->plan_type_name }}</td>
            <td width="10%">1</td>
            <td width="20%">${{ $decimalFee }}</td>
            <td width="20%">${{ $decimalFee }}</td>
        </tr>
        <tr style="height: 50px;">
            <td colspan="4"></td>
        </tr>
        <tr>
            <td style="padding-left: 10px;" colspan="3" width="80%">Subtotal:</td>
            <td width="20%">${{ $decimalFee }}</td>
        </tr>
        <tr>
            <td style="padding-left: 10px;" colspan="3" width="80%">Total:</td>
            <td width="20%">${{ $fullFee }}</td>
        </tr>
        <tr>
            <td style="padding-left: 10px;" colspan="3" width="80%">GST:</td>
            <td width="20%">${{ $gst }}</td>
        </tr>
        <tr style="background-color: #eeeeee;">
            <td style="font-weight: bold; padding-left: 10px;" colspan="3" width="80%">Amount paid:</td>
            <td width="20%">${{ $fullFee }}</td>
        </tr>
    </table>
</div>

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
