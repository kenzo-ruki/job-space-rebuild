@php
$decimalFee = round($rate->fee, 2);
$gst = round($rate->fee * 0.15, 2);
$fullFee = round($rate->fee * 1.15, 2);
@endphp
<html lang="en">
    <head>
        <title>Invoice</title>
        <!-- Fonts -->
            <style>
                .invoice-box {
                    max-width: 800px;
                    margin: auto;
                    padding: 30px;
                    border: 1px solid #eee;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                    color: #555;
                }

                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                    text-align: left;
                }

                .invoice-box table td {
                    padding: 5px;
                    vertical-align: top;
                }

                .invoice-box table tr td:nth-child(2) {
                    text-align: right;
                }

                .invoice-box table tr.top table td {
                    padding-bottom: 20px;
                }

                .invoice-box table tr.top table td.title {
                    font-size: 45px;
                    line-height: 45px;
                    color: #333;
                }

                .invoice-box table tr.information table td {
                    padding-bottom: 40px;
                }

                .invoice-box table tr.heading td {
                    background: #eee;
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }

                .invoice-box table tr.details td {
                    padding-bottom: 20px;
                }

                .invoice-box table tr.item td {
                    border-bottom: 1px solid #eee;
                }

                .invoice-box table tr.item.last td {
                    border-bottom: none;
                }

                .invoice-box table tr.total td:nth-child(2) {
                    border-bottom: 2px solid #eee;
                    font-weight: bold;
                }

                @media only screen and (max-width: 600px) {
                    .invoice-box table tr.top table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }

                    .invoice-box table tr.information table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                }

                /** RTL **/
                .invoice-box.rtl {
                    direction: rtl;
                    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                }

                .text-right,
                .invoice-box.rtl table {
                    text-align: right !important;
                }

                .text-left,
                .invoice-box.rtl table tr td:nth-child(2) {
                    text-align: left !important;
                }
            </style>
    </head>
	<body>
		<div class="invoice-box">
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
				<tr class="top" width="100%">
                    <td width="100%" colspan="2">
                        <img style="height: 4rem; width:auto;" src="{{ url('/img/logo.png') }}" alt="Logo">
                    </td>
				</tr>
                <tr style="height: 50px;">
                    <td colspan="2"></td>
                </tr>
				<tr class="information">
                    <td>
                        {{ $orderData['personal_details']['name'] }}<br>
                        @foreach ($orderData['billing_details'] as $value)
                            @if ($value)
                                {{ $value }}<br>
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right">
                        Subscription Invoice<br />
                        Date: {{ $orderData['date_purchased'] }}<br />
                        Currency: NZD - NZ Dollar<br />
                        Billing method: PayPal
                    </td>
				</tr>
                <tr style="height: 50px;">
                    <td colspan="2"></td>
                </tr>
			</table>
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
				<tr class="heading">
					<td width="50%">Item</td>
					<td width="10%">Qty</td>
                    <td width="20%">Rate</td>
                    <td width="20%">Amount</td>
				</tr>

				<tr class="item last">
					<td width="50%">{{ $rate->plan_type_name }}</td>
					<td width="10%">1</td>
                    <td width="20%">${{ $decimalFee }}</td>
                    <td class="text-right" width="20%">${{ $decimalFee }}</td>
				</tr>
                <tr style="height: 50px;">
                    <td colspan="4"></td>
                </tr>
				<tr class="total">
                    <td colspan="3" width="80%" class="text-right">Subtotal:</td>
                    <td width="20%">${{ $decimalFee }}</td>
				</tr>
				<tr class="total">
                    <td colspan="3" width="80%" class="text-right">Total:</td>
                    <td width="20%">${{ $fullFee }}</td>
                </tr>
				<tr class="total">
                    <td colspan="3" width="80%" class="text-right">GST:</td>
                    <td width="20%">${{ $gst }}</td>
                </tr>
				<tr class="total">
                    <td colspan="3" width="80%" class="text-right">Amount paid:</td>
                    <td width="20%">${{ $fullFee }}</td>
                </tr>
			</table>
		</div>
	</body>
</html>