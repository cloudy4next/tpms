<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deposit_apply_transaction extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id'];


    public function ledger_list()
    {
        return $this->belongsTo(ledger_list::class);
    }


}
