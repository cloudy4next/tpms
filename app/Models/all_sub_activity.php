<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class all_sub_activity extends Model
{
    use HasFactory;
    protected $fillable=['admin_id','sub_activity'];
}
