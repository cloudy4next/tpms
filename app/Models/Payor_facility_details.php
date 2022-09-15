<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payor_facility_details extends Model
{
    use HasFactory;
    protected $fillable=['facility_id','name','address','city','state','zip','contact_one','contact_two','phone_one','phone_two','payor_id','billing_aber','ele_payor_id','create_by',
        'plain_medicare','plan_medicalid','plan_campus','plan_champva','plan_group_health','plan_feca','plan_others'];
}
