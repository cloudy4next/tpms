<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'client';

    protected $fillable = ['admin_id',
        'is_up_admin',
        'down_admin_id',
        'is_active_client',
        'client_type',
        'client_full_name',
        'client_first_name',
        'client_middle',
        'client_last_name',
        'client_preferred',
        'client_gender',
        'client_dob',
        'email',
        'email_type', 'email_reminder',
        'is_email_ok', 'phone_number',
        'phone_type', 'is_send_sms',
        'is_voice_sms', 'location',
        'zone', 'client_street',
        'client_city', 'client_state',
        'client_zip', 'supervisor_name'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
