<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payor_details_tx_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'treatment_id',
        'treatment_name',
        'box_24j',
        'id_qualifire',
    ];
}
