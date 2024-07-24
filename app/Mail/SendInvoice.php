<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\LaravelDriver\MailerSendTrait;
use App\Models\Order;
use App\Models\Rate;
use App\Utilities\InvoiceHelpers;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * The rate instance.
     *
     * @var \App\Models\Rate
     */
    public Rate $rate;

    /**
     * The order text data.
     */
    public array $orderData;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->rate = Rate::where('product_id', $this->order->product_id)->first();
        $this->orderData = InvoiceHelpers::getInvoiceData();
        $this->orderData['date_purchased'] = $this->order->date_purchased;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'JobSpace Invoice',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(markdown: 'emails.orders.invoice');
    }
}
