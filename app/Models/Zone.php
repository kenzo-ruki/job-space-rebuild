<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $primaryKey = 'zone_id';

    public $timestamps = false;

    protected $fillable = [
        'zone_country_id',
        'zone_code',
        'zone_name',
        'slug'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'zone_country_id');
    }
}