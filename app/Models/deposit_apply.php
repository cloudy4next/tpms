<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deposit_apply extends Model
{
    use HasFactory;

//    public function ledger_list()
//    {
//        return $this->belongsTo(ledger_list::class);
//    }

    protected $fillable = ['admin_id',
        'deopsit_id',
        'batching_claim_id',
        'appointment_id',
        'client_id',
        'provider_id',
        'authorization_id',
        'activity_id',
        'payor_id',
        'dos',
        'units',
        'cpt',
        'm1',
        'm2',
        'm3',
        'm4',
        'm5',
        'amount',
        'payment',
        'adjustment',
        'balance',
        'reason',
        'status',
        'see_payor',
        'provider_24j',
        'status_apply',
        'billed_am',
        'id_qualifier',
        'degree_level',
        'zone',
        'location',
        'units_value_calc',
        'has_seceondary',
        'has_claim_id',
        'sec_submited',
    ];


    public function batchingClaim()
    {
        return $this->hasOne(Batching_claim::class, 'id', 'batching_claim_id');
    }


    public function clientAuth()
    {
        return $this->hasOne(Client_authorization::class, 'id', 'client_id')->select('id', 'client_id', 'is_primary', 'payor_id');
    }


    public function providerj()
    {
        return $this->hasOne(Employee::class, 'id', 'provider_24j')->select('id', 'first_name', 'middle_name', 'last_name');
    }


}
