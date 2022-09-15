<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_address extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'is_up_admin', 'down_admin_id', 'client_id', 'street', 'city', 'state', 'zip', 'location'];
}
