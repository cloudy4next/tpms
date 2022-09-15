<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batching_claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'down_admin_id',
        'processing_claim_id',
        'appointment_id',
        'client_id',
        'provider_id',
        'authorization_id',
        'activity_id',
        'payor_id',
        'activity_type',
        'schedule_date',
        'from_time',
        'to_time',
        'cpt',
        'm1',
        'm2',
        'm3',
        'm4',
        'pos',
        'units',
        'rate',
        'cms_24j',
        'id_qualifier',
        'status',
        'degree_level',
        'zone',
        'location',
        'units_value_calc',
        'billed_am',
        'billed_date',
        'is_mark_gen',
        'has_manage_claim',
        'has_legder',
    ];


    public function appoinment()
    {
        return $this->hasOne(Appoinment::class, 'id', 'appointment_id');
    }

    public function processClaim()
    {
        return $this->hasOne(Processing_claim::class, 'id', 'processing_claim_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'admin_id', 'client_full_name');
    }

    public function provider()
    {
        return $this->hasOne(Employee::class, 'id', 'provider_id')->select('id', 'admin_id', 'full_name');
    }

    public function providerj()
    {
        return $this->hasOne(Employee::class, 'id', 'cms_24j')->select('id', 'admin_id', 'full_name');
    }

    public function clientAuthAct()
    {
        return $this->hasOne(Client_authorization_activity::class, 'id', 'activity_id');
    }
}
