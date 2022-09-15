<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_employee_type extends Model
{
    use HasFactory;
    protected $fillable=['type_name'];
}
