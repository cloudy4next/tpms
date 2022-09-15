<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manage_claim_transaction extends Model
{
    use HasFactory;

    protected $fillable = ['claim_id', 'batch_id', 'appointment_id', 'client_id', 'provider_id', 'activity_id', 'payor_id', 'activity_type', 'schedule_date', 'cpt', 'm1', 'm2', 'm3',
        'm4', 'pos', 'units', 'rate', 'cms_24j', 'id_qualifier', 'status', 'degree_level', 'zone', 'location', 'units_value_calc', 'billed_am', 'billed_date'];


    public function appoinment()
    {
        return $this->hasOne(Appoinment::class, 'id', 'appointment_id');
    }

    public function batchingClaim()
    {
        return $this->hasOne(Batching_claim::class, 'id', 'baching_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'admin_id', 'client_full_name');
    }

    public function clientAuth()
    {
        return $this->hasOne(Client_authorization::class, 'id', 'authorization_id');
    }


    public function depositApplyTransaction()
    {
        return $this->hasOne(deposit_apply_transaction::class, 'appointment_id', 'appointment_id');
    }

}
