<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use App\Enum\UserRole;
use App\Models\SavedSearch;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'city',
        'country',
        'phone',
        'recruiter_id',
        'newsletter',
        'contact_details_visibility',
        'cv_visible',
        'jobseeker_id',
        'video_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Determine if the user can access the Filament admin panel.
     *
     * @param \Filament\Panel $panel
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(UserRole::ADMIN) && $this->active_status;
    }

    /**
     * Define the user saved searches relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function savedSearches()
    {
        return $this->hasMany(SavedSearch::class);
    }

    public function jobPreference()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_id', 'recruiter_id');
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'jobseeker_id', 'jobseeker_id');
    }

    public function canViewResume($resumeId)
    {
        if (is_numeric($resumeId)) {
            $resume = Resume::find($resumeId);
        } else {
            $resume = $resumeId;
        }
        $user = Auth::user();
        return $resume !== null && $resume->jobseeker_id == $user->jobseeker_id;
    }

    public function hasResume()
    {
        return $this->resumes()->exists();
    }
}
