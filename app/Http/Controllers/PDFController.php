<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Rate;
use App\Utilities\InvoiceHelpers;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Order   $order   Model
     *
     */
    public function invoice(Order $order)
    {
        if (!$order->status === 3 || $order->date_purchased > Carbon::now()) {
            throw new NotFoundHttpException();
        }
        $rate = Rate::where('product_id', $order->product_id)->first();
        $orderData = InvoiceHelpers::getInvoiceData();
        $orderData['date_purchased'] = $order->date_purchased;
        return view('orders.pdf-invoice', ['orderData' => $orderData, 'rate'=>$rate ]);
        /*
        $pdf = Pdf::loadView('pdf.invoice', ['orderData' => $orderData, 'rate'=>$rate ]);
        return $pdf->download('invoice.pdf');
        */
    }
}
