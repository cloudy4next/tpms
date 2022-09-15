<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_type_assign extends Model
{
    use HasFactory;
    protected $fillable=['admin_id','type_id','type_name'];
}
