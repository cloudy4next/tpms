<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting_name_location_box_two extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'facility_name_two', 'zone_name', 'address', 'city', 'state', 'zip', 'phone_one', 'npi', 'admin_create'];
}
