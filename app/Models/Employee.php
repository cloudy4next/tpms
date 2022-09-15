<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
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

    protected $guard = 'provider';
    protected $fillable = [
        'admin_id',
        'is_active',
        'up_admin_id',
        'employee_type',
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'full_name',
        'nickname',
        'staff_birthday',
        'ssn',
        'staff_other_id',
        'office_phone',
        'office_fax',
        'office_email',
        'driver_license',
        'license_exp_date',
        'title',
        'hir_date_compnay',
        'credential_type',
        'treatment_type',
        'individual_npi',
        'caqh_id',
        'service_area_zip',
        'terminated_date',
        'language',
        'taxonomy_code',
        'gender',
        'military_service',
        'therapist_bill',
        'is_staff_active',
        'enable_fource_creation',
        'has_catalsty_access',
        'notes',
        'login_email',
        'password',
        'remember_token',
        'back_color',
        'text_color',
        'gcalendar_integration',
        'gcalendar_access_tokken',
        'gcalendar_refresh_tokken',
        'profile_color',
        'timezone',
    ];

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
