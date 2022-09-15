<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_authorization_activity extends Model
{
    use HasFactory;
    protected $fillable=['client_id','dup_name','activity_name','authorization_id','activity_one','activity_two','cpt_code','onset_date','end_date','m1','m2','m3','m4','auth_activity','billed_type','billed_time',
        'rate','hours_max_one','hours_max_per_one','hours_max_is_one','hours_max_two','hours_max_per_two','hours_max_is_two','hours_max_three','hours_max_per_three','hours_max_is_three','notes'];
}
