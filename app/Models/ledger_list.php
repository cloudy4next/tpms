<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ledger_list extends Model
{
    use HasFactory;


    protected $casts = [
        'amount' => 'float:2'
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'admin_id', 'client_full_name', 'client_dob');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'provider_id')->select('id', 'full_name');
    }

    public function authorization()
    {
        return $this->hasOne(Client_authorization::class, 'id', 'authorization_id')->select('id', 'uci_id', 'onset_date', 'end_date', 'authorization_number', 'supervisor_id');
    }

    public function dep_apply()
    {
        return $this->hasOne(deposit_apply::class, 'batching_claim_id', 'batching_id')->select('id', 'uci_id', 'onset_date', 'end_date', 'authorization_number', 'supervisor_id');
    }


    public function manage_claim()
    {
        return $this->hasOne(manage_claim_transaction::class, 'baching_id', 'batching_id')->select('admin_id', 'claim_id', 'baching_id');
    }

    public function ledger_client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'client_full_name');
    }

    public function ledger_provider()
    {
        return $this->hasOne(Employee::class, 'id', 'cms_24j')->select('id', 'full_name');
    }

    public function ledger_payor()
    {
        return $this->hasOne(All_payor_detail::class, 'payor_id', 'payor_id')
            ->select('payor_id', 'payor_name');
    }

    public function deposit_apply()
    {
        return $this->hasOne(deposit_apply::class, 'batching_claim_id', 'batching_id');

    }

    public function deposit_apply_paid()
    {
        return $this->hasMany(deposit_apply_transaction::class, 'batching_claim_id', 'batching_id');
    }


}
