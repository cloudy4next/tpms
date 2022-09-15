<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_payor extends Model
{
    use HasFactory;
    protected $fillable=['facility_payor_id','payor_name','co_pay','day_club','is_capital','cms_1500_31','cms_1500_32a','cms_1500_32b','cms_1500_33a','cms_1500_33b','is_active'];
}
