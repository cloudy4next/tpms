<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manage_claim extends Model
{
    use HasFactory;
    protected $fillable=['claim_id','batch_id','appointment_id','client_id','provider_id','activity_id','payor_id','activity_type','schedule_date','cpt','m1','m2',
        'm3','m4','pos','units','rate','cms_24j','id_qualifier','status','degree_level','zone','location','units_value_calc','billed_am','billed_date','is_mark_gen'];
}
