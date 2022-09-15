<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payor_facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'payor_id',
        'facility_payor_id',
        'payor_name',
        'address',
        'city',
        'state',
        'zip',
        'contact_one',
        'contact_two',
        'phone_one',
        'phone_two',
        'fpayor_id',
        'is_regional_center',
        'regional_center_name',
        'billing_aber',
        'ele_payor_id',
        'create_by',
        'plain_medicare',
        'plan_medicalid',
        'plan_campus',
        'plan_champva',
        'plan_group_health',
        'plan_feca',
        'plan_others',
        'claim_filing_indicator',
        'payor_file',
    ];
}
