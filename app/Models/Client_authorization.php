<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_authorization extends Model
{
    use HasFactory;
    protected $fillable=['client_id','authorization_name','payor_id','treatment_type','supervisor_id','description','selected_date','onset_date','end_date','authorization_number','uci_id','cms_four','csm_eleven','diagnosis_one','diagnosis_two','diagnosis_three','diagnosis_four','deductible','in_network',
        'copay','max_total_auth','value','upload_authorization','notes','is_primary','is_placeholder','is_valid'];
}
