<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ledger_note extends Model
{
    use HasFactory;

    public function client(){
        return $this->hasOne(Client::class,'id','client_id');
    }


    public function payor(){
        return $this->hasOne(Payor_facility::class,'payor_id','payor_id');
    }

    public function cpt(){
        return $this->hasOne(setting_service::class,'service','cpt_code');
    }



}
