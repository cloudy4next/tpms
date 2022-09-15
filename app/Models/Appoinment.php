<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'admin_id',
        'is_mark_gen',
        'g_event_id',
        'recurring_id',
        'billable',
        'client_id',
        'authorization_id',
        'authorization_activity_id',
        'payor_id',
        'provider_id',
        'location',
        'time_duration',
        'from_time',
        'activity_type',
        'to_time',
        'cpt_code',
        'schedule_date',
        'status',
        'notes',
        'm1', 'm2', 'm3', 'm4',
        'weekly_date', 'week_day_name',
        'degree_level',
        'gender',
        'zone',
        'zip_code',
        'lagunage'
    ];


    public function scopeBillable($query)
    {
        return $query->where('billable', 1);
    }

    public function scopeNonBillable($query)
    {
        return $query->where('billable', 2);
    }

    public function appClient()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')->select('id', 'client_full_name');
    }

    public function appClientAuthAct()
    {
        return $this->hasOne(Client_authorization_activity::class, 'id', 'authorization_activity_id')->select('id', 'activity_name');
    }

    public function appProvider()
    {
        return $this->hasOne(Employee::class, 'id', 'provider_id')->select('id', 'first_name', 'middle_name', 'last_name');
    }

}
