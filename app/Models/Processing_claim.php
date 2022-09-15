<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processing_claim extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'client_id', 'provider_id', 'activity_id', 'payor_id', 'activity_type', 'schedule_date', 'cpt', 'm1', 'm2', 'm3', 'm4', 'pos', 'units', 'rate',
        'cms_24j', 'id_qualifier', 'status', 'degree_level', 'zone', 'location'];


    public function scopeIsBillable($query)
    {
        return $query->where('billable', 1);
    }

    public function scopeIsLocked($query)
    {
        return $query->where('is_locked', 0);
    }

    public function scopeIsShow($query)
    {
        return $query->where('is_show', 0);
    }


    public function scopeStatus($query)
    {
        return $query->where('status', 'Rendered');
    }


    public function processApp()
    {
        return $this->hasOne(Appoinment::class, 'id', 'appointment_id');
    }

    public function processClient()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'client_first_name', 'client_middle', 'client_last_name');
    }


    public function processProvider()
    {
        return $this->hasOne(Employee::class, 'id', 'provider_id')->select('id', 'first_name', 'middle_name', 'last_name');
    }

    public function processProviderj()
    {
        return $this->hasOne(Employee::class, 'id', 'cms_24j')->select('id', 'first_name', 'middle_name', 'last_name');
    }

    public function processClientAuthAct()
    {
        return $this->hasOne(Client_authorization_activity::class, 'id', 'activity_id')->select('id', 'activity_type');
    }


}
