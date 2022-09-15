<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_activity extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'is_up_admin', 'down_admin_id', 'who_created', 'client_id', 'title', 'message', 'act_date'];
}
