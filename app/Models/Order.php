<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\OrderStatus;

class Order extends Model 
{
    protected $primaryKey = 'orders_id';

    public $timestamps = false;

    protected $fillable = [
        'recruiter_id',
        'product_id', 
        'recruiter_name',
        'recruiter_email_address',
        'recruiter_company',
        'recruiter_street_address',
        'recruiter_zip',
        'recruiter_city',
        'recruiter_state',
        'recruiter_country',
        'recruiter_telephone',
        'billing_name',
        'billing_company',
        'billing_street_address',
        'billing_city',
        'billing_state',
        'billing_country',
        'billing_zip',
        'billing_telephone',
        'payment_method',
        'last_modified',
        'date_purchased',
        'orders_status',
        'orders_date_finished'
    ];

    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2; 
    const STATUS_COMPLETED = 3;

    protected $casts = [
      'order_status' => 'enum'
    ];

    protected $enumCasts = [
      'order_status' => OrderStatus::class
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }

    public function createAccountHistory()
    {
        $accountHistoryParams = [];
        // Loop through fillable fields on Order 
        foreach ($this->getFillable() as $fillableField) {
            if ($this->$fillableField && in_array($fillableField, AccountHistory::$fillable)) {
                $accountHistoryParams[$fillableField] = $this->$fillableField; 
            }
        }
    
        return AccountHistory::create($accountHistoryParams);
    
    }
  
}
