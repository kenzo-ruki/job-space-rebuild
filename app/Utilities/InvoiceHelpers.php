<?php

namespace App\Utilities;
use App\Models\Rate;

class InvoiceHelpers
{
    
    public static function getOrderData(Rate $rate)
    {
        $recruiter = auth()->user()->recruiter;
        $address = $recruiter->recruiter_address1 . ', ' . $recruiter->recruiter_address2;
        $name = $recruiter->recruiter_first_name .' '. $recruiter->recruiter_last_name;
        $orderData = [
            'recruiter_id' => $recruiter->recruiter_id,
            'product_id' => $rate->product_id,
            'recruiter_name' => $name,
            'recruiter_company' => $recruiter->recruiter_company_name,
            'recruiter_email_address' => auth()->user()->email,
            'recruiter_street_address' => $address,
            'recruiter_city' => $recruiter->recruiter_city,
            'recruiter_state' => $recruiter->zone->zone_name,
            'recruiter_country' => $recruiter->country->name,
            'recruiter_zip' => $recruiter->recruiter_zip,
            'recruiter_telephone' => $recruiter->recruiter_telephone,
            'billing_name' => $name,
            'billing_company' => $recruiter->recruiter_company_name,
            'billing_street_address' => $address,
            'billing_city' => $recruiter->recruiter_city,
            'billing_state' => $recruiter->zone->zone_name,
            'billing_country' => $recruiter->country->name,
            'billing_zip' => $recruiter->recruiter_zip,
            'billing_telephone' => $recruiter->recruiter_telephone,
            'payment_method' => 'PayPal',
        ];
        return $orderData;
    }

    public static function getInvoiceData()
    {
        $recruiter = auth()->user()->recruiter;
        $address = $recruiter->recruiter_address1 . ', ' . $recruiter->recruiter_address2;
        $name = $recruiter->recruiter_first_name .' '. $recruiter->recruiter_last_name;
        $invoiceData = [
            'personal_details' => [
                'email' => auth()->user()->email,
                'name' => $name,
            ],
            'recruiter' => [
                $name,
                $recruiter->recruiter_company_name,
                auth()->user()->email,
                $recruiter->recruiter
            ],
            'billing_details' => [
                $address,
                $recruiter->recruiter_city,
                $recruiter->zone->zone_name,
                $recruiter->country->name,
                $recruiter->recruiter_zip,
                $recruiter->recruiter_telephone,
            ]
        ];
        return $invoiceData;
    }
}