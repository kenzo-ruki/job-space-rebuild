<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Rate;
use App\Models\Order;
use App\Models\AccountHistory;
use App\Utilities\FlashMessage;
use App\Utilities\InvoiceHelpers;
use App\Mail\SendInvoice;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function create(Rate $rate)
    {
        $invoiceData = InvoiceHelpers::getInvoiceData();
        return view('orders.create', ['invoiceData' => $invoiceData, 'rate'=>$rate ]);
    }

    public function view(Order $order)
    {
        $rate = Rate::where('product_id', $order->product_id)->first();
        $orderData = InvoiceHelpers::getInvoiceData();
        $orderData['date_purchased'] = $order->date_purchased;
        return view('orders.view', ['orderData' => $orderData, 'order' => $order, 'rate'=>$rate]);
    }

    /**
     * Process transaction.
     */
    public function process(Request $request, Rate $rate)
    {
        $orderData = InvoiceHelpers::getOrderData($rate);
        $order = Order::create($orderData);
        $provider = new PayPalClient;
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('order.success', [ 'order' => $order->orders_id ]),
                "cancel_url" => route('rates'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "NZD",
                        "value" => round($rate->fee * 1.15, 2),
                    ],
                    "reference_id" => $order->id,
                    "description" => $rate->plan_type_name,
                    "invoice_id" => $order->id,
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            FlashMessage::error('Something went wrong.');
            return redirect()
                ->route('order.create', ['order' => $orderData, 'rate'=>$rate ]);

        } else {
            FlashMessage::error($response['message'] ?? 'Something went wrong.');
            return redirect()
                ->route('order.create', ['order' => $orderData, 'rate'=>$rate ]);
        }
        
    }

    /**
     * Success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request, Order $order)
    {
        $provider = new PayPalClient;
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $rate = Rate::where('product_id', $order->product_id)->first();
        $orderData = InvoiceHelpers::getOrderData($rate);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Order success, so attempt to update and send invoice.
            try {
                Mail::to($order->recruiter_email_address)
                    ->send(new SendInvoice($order));
                $this->createAccountHistory($order);
                FlashMessage::success('Transaction complete.');
                return redirect()
                    ->to(route('recruiter.dashboard') . '#subscriptions');
            } catch (\Exception $e) {
                FlashMessage::error($e->getMessage());
                return redirect()
                    ->route('order.create', ['order' => $orderData, 'rate'=>$rate ]);
            }
        } else {
            // Paypal returned an error.
            FlashMessage::error($response['message'] ?? 'Something went wrong.');
            return redirect()
                ->route('order.create', ['order' => $orderData, 'rate'=>$rate ]);
        }
    }

    private function createAccountHistory(Order $order)
    {
        $recruiter = auth()->user()->recruiter;
        $rate = Rate::where('product_id', $order->product_id)->first();
        $start = date('Y-m-d H:i:s');
        $months = $rate->time_period_months;
        $end = date('Y-m-d H:i:s', strtotime("+$months months"));
        $jobs = (int) $rate->number_of_postable_jobs;
        if ($rate->jobs_show_as_featured == 1) {
            $featured = 'Yes';
            $recruiter_cv_status = 'Yes';
        } else {
            $recruiter_cv_status = 'No';
            $featured = 'No';
        }
        $accountHistoryParams = [
            'recruiter_id' => $recruiter->recruiter_id,
            'order_id' => $order->orders_id,
            'inserted' => $start,
            'updated' => $start,
            'plan_type_name' => $rate->plan_type_name,
            'plan_for' => 'job_post',
            'start_date' => $start,
            'end_date' => $end,
            'recruiter_job' => $rate->number_of_postable_jobs,
            'recruiter_cv_status' => $recruiter_cv_status,
            'recruiter_cv' => 0,
            'job_enjoyed' => 0,
            'cv_enjoyed' => 0,
            'featured_job' => $featured,
        ];
        AccountHistory::create($accountHistoryParams);
        
        if ($jobs > 1000) {
            $accountHistoryParams['plan_for'] = 'resume_search';
            $accountHistoryParams['recruiter_cv'] = $rate->search_cvs;
            AccountHistory::create($accountHistoryParams);
        }

        $order->update([
            'orders_status' => 3,
            'date_purchased' => $start,
            'orders_date_finished' => $end,
        ]);
    
    }
}
