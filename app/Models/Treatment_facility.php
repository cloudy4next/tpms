<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment_facility extends Model
{
    use HasFactory;
    protected $fillable=['admin_id','treatment_id','treatment_name'];
}
