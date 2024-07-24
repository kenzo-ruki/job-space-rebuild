<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Country;
use App\Models\Zone;
use App\Utilities\RecruiterCredits;

class Recruiter extends Model
{
    use HasFactory;

    protected $table = 'recruiters';
    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'recruiter_id';

    protected $fillable = [
        'recruiter_email_address',
        'recruiter_first_name',
        'recruiter_last_name',
        'recruiter_position',
        'recruiter_company_name',
        'recruiter_company_seo_name',
        'recruiter_address1',
        'recruiter_address2',
        'recruiter_city',
        'recruiter_country_id',
        'recruiter_state_id',
        'recruiter_zip',
        'recruiter_telephone',
        'recruiter_logo',
        'recruiter_url',
        'recruiter_featured',
        'recruiter_applywithoutlogin'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'recruiter_city');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'recruiter_country_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'recruiter_state_id');
    }

    public function getLogo()
    {
        if (str_starts_with($this->recruiter_logo, 'http')) {
            return $this->recruiter_logo;
        }

        $imagePath = 'recruiter_photos/' . $this->recruiter_logo;
        return asset('storage/' . $imagePath);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function accountHistories()
    {
        return $this->hasMany(AccountHistory::class, 'recruiter_id');
    }

    public function canViewInvoice($invoice)
    {
        return $this->recruiter_id === $invoice->recruiter_id;
    }

    public function canViewResume()
    {
        return RecruiterCredits::getCVCredits();
    }

    public function jobs() {
        return $this->hasMany(Job::class, 'recruiter_id', 'recruiter_id');
    }
}
