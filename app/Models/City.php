<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $primaryKey = 'city_id';

    public $timestamps = false;

    protected $fillable = [
        'city_country_id',
        'city_zone_id',
        'city_name'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'city_country_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'city_zone_id');
    }
}