<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{

    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'inserted',
        'plan_type_name',
        'time_period',
        'time_string',
        'fee',
        'cv',
        'featured_job',
        'total_price'
    ];

    protected $casts = [
        'inserted' => 'datetime',
        'fee' => 'float',
        'total_price' => 'float'
    ];

}
