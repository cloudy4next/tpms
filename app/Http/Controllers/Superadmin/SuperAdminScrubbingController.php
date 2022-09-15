<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\scrubbing_rule;
use App\Models\scrubbing_rules_assign;
use App\Models\All_payor_detail;
use App\Models\Employee_exclude_payor;
use App\Models\Employee;
use App\Models\Employee_type_assign;
use App\Models\Payor_facility;
use App\Models\setting_cpt_code;
use App\Models\cpt_code_exclusion;
use App\Models\rate_list;
use App\Models\Client_authorization;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminScrubbingController extends Controller
{
    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->is_up_admin == 1) {
                $this->admin_id = Auth::user()->id;
            } else {
                $this->admin_id = Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }
    
    public function fetch_scrubbing_info(Request $request){
        $alls=scrubbing_rule::all();
        $result=[];
        $payer=All_payor_detail::select('payor_id')->where('id',$request->id)->first();
        foreach($alls as $all){
            $current=scrubbing_rules_assign::where('admin_id',$this->admin_id)->where('payer_id',$payer->payor_id)->where('rule_id',$all->id)->first();
            if($current){
                $found="found";
                $run=$current->run;
                $prevent=$current->prevent;
                $id=$current->id;
            }
            else{
                $found="notfound";
                $run=2;
                $prevent=2;
                $id=0;
            }

            $arr = [
                "id" => $all->id,
                "rule" => $all->rule,
                "description" => $all->description,
                "payer_id" => $request->id,
                "assign_id" => $id,
                "found" => $found,
                "run" => $run,
                "prevent" => $prevent
            ];
            array_push($result, $arr);
        }
        return response()->json([

            "data" => $result,
            "view" => \View::make('superadmin.settingFacilitySetup.include.scrubbingInfo', compact('result'))->render(),

        ]);
    }


    public function save_scrubbing_info(Request $request)
    {
        $i = 0;
        foreach ($request->ids as $id) {
            $payer = all_payor_detail::select('payor_id')->where('id', $request->ins_id)->first();
            $p_id = $payer->payor_id;
            $data = scrubbing_rules_assign::where('admin_id', $this->admin_id)->where('payer_id', $p_id)->where('rule_id', $id)->first();
            if ($data) {
                $data->admin_id = $this->admin_id;
                $data->rule_id = $id;
                $data->payer_id = $p_id;
                $data->run = $request->run[$i];
                $data->prevent = $request->prevent[$i];
                $data->save();
            } else {
                $new = new scrubbing_rules_assign();
                $new->admin_id = $this->admin_id;
                $new->rule_id = $id;
                $new->payer_id = $p_id;
                $new->run = $request->run[$i];
                $new->prevent = $request->prevent[$i];
                $new->save();
            }
            $i++;
        }

        return "success";
    }


    public function run_scrubbing(Request $request)
    {

        $obj = $request->data;
        $obj = json_decode($obj);
        $report = [];
        $ins_id = $obj[0]->ins_id;
        $sd_dup = [];
        $sc_id = [];
        foreach ($obj as $el) {
            $client_id = $el->clientId;
            $date = $el->scheduleDate;
            $com = $client_id . '#' . $date;
            array_push($sd_dup, $com);
            array_push($sc_id, $el->id);
        }

        $sd_dup = array_count_values($sd_dup);

        $scrubbing = scrubbing_rules_assign::select('rule_id')->where('admin_id', $this->admin_id)->where('payer_id', $ins_id)->where('run', 1)->orderBy('rule_id', 'ASC')->get();

        $prevent = [];

        for ($i = 0; $i < 10; $i++) {
            $p = $i + 1;
            $pre = scrubbing_rules_assign::select('prevent')->where('admin_id', $this->admin_id)->where('payer_id', $ins_id)->where('rule_id', $p)->first();
            if ($pre) {
                $prevent[$i] = $pre->prevent;
            } else {
                $prevent[$i] = 2;
            }

        }

        $rules = [];
        foreach ($scrubbing as $scrub) {
            array_push($rules, $scrub->rule_id);
        }


        foreach ($obj as $el) {
            $id = $el->id;
            $ins_id = $el->ins_id;
            $client_id = $el->clientId;
            $date = $el->scheduleDate;
            $provider_id = $el->providerId;
            $activity_id = $el->activityId;
            $hours = $el->hours;
            $activity_type = $el->activityType;
            $cpt = $el->cpt;
            $location = $el->location;
            $m1 = $el->m1;
            $m2 = $el->m2;
            $m3 = $el->m3;
            $m4 = $el->m4;
            $unit = $el->unit;
            $rate = $el->rate;
            $cms = $el->cms;
            $qual = $el->qual;
            $status = $el->status;
            $auth_id = $el->auth_id;


            if (in_array(1, $rules)) {

                $s1 = Employee_exclude_payor::where('employee_id', $provider_id)->where('payor_id', $ins_id)->exists();
                if ($s1) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 1,
                        "description" => "Charges MUST be billed under the credentialed provider",
                        "prevent" => $prevent[0],
                    ]);
                }
            }

            if (in_array(2, $rules)) {
                $s2 = cpt_code_exclusion::where('admin_id', $this->admin_id)->where('cpt_code', $cpt)->exists();
                if ($s2) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 2,
                        "description" => "Cpt code is not valid.",
                        "prevent" => $prevent[1],

                    ]);
                }
            }


            if (in_array(3, $rules)) {
                $s_cpt = setting_cpt_code::where('cpt_code', $cpt)->first();
                if ($s_cpt) {
                    $cpt_id = $s_cpt->id;
                    $s3 = rate_list::where('admin_id', $this->admin_id)->where('cpt_code', $cpt_id)->where('payor_id', $ins_id)->where('activity_type', $activity_type)->first();
                    if ($s3) {
                        $s_rate = $s3->contracted_rate;
                        if ($s_rate == $rate) {
                        } else {
                            array_push($report, [
                                "claim_id" => $id,
                                "code" => 3,
                                "description" => "Sessions MUST be billed with appropriate activity & Coding (review the rate sheet)",
                                "prevent" => $prevent[2],

                            ]);
                        }
                    }
                }
            }


            if (in_array(4, $rules)) {
                if ($location == 02 || $location == 2) {
                    if (
                        $m1 == "95" || $m1 == "GT" ||
                        $m2 == "95" || $m2 == "GT" ||
                        $m3 == "95" || $m3 == "GT" ||
                        $m4 == "95" || $m4 == "GT"
                    ) {
                    } else {
                        array_push($report, [
                            "claim_id" => $id,
                            "code" => 4,
                            "description" => "All POS 2 Claims should go with 95 or GT modifier",
                            "prevent" => $prevent[3],
                        ]);
                    }
                }
            }

            if(in_array(5,$rules)){
                $provider=Employee::select('credential_type')->where('id',$provider_id)->first();
                $cred=Employee_type_assign::select('type_id')->where('id',$provider->credential_type)->first();
                if($cred){
                    if($cred->type_id==21){
                        //BCBA
                        if($m1=="HO" || $m2=="HO" || $m3=="HO" || $m4=="HO"){

                        }
                        else{
                            array_push($report,[
                                "claim_id"=>$id,
                                "code"=>5,
                                "description"=>"Append Modifier based on Provider Degree",
                                "prevent"=>$prevent[4],
                            ]);
                        }
                    }
                    else if($cred->type_id==23){
                        //RBT
                        if($m1=="HN" || $m2=="HN" || $m3=="HN" || $m4=="HN"){

                        }
                        else{
                            array_push($report,[
                                "claim_id"=>$id,
                                "code"=>5,
                                "description"=>"Append Modifier based on Provider Degree",
                                "prevent"=>$prevent[4],
                            ]);
                        }
                    }   
                    else if($cred->type_id==36){
                        //BCABA
                        if($m1=="HM" || $m2=="HM" || $m3=="HM" || $m4=="HM"){

                        }
                        else{
                            array_push($report,[
                                "claim_id"=>$id,
                                "code"=>5,
                                "description"=>"Append Modifier based on Provider Degree",
                                "prevent"=>$prevent[4],
                            ]);
                        }
                    }
                }
            }

            if (in_array(6, $rules)) {
                if (fmod($unit, 1) !== 0.00) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 6,
                        "description" => "Units Must be always Round off",
                        "prevent" => $prevent[5],
                    ]);
                }
            }

            if (in_array(7, $rules)) {
                if ($auth_id == null || $auth_id == '' || $auth_id == 0) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 6,
                        "description" => "ABA claims always bill with auth#",
                        "prevent" => $prevent[6],
                    ]);
                }
                else{
                    $auth=Client_authorization::select('authorization_number')->where('id',$auth_id)->first();
                    if($auth->authorization_number=='' || $auth->authorization_number==null){
                        array_push($report,[
                            "claim_id"=>$id,
                            "code"=>6,
                            "description"=>"ABA claims always bill with auth#",
                            "prevent"=>$prevent[6],
                        ]);
                    }
                }
            }

            if (in_array(8, $rules)) {
                if ($unit == 0 || $unit == 0.00) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 8,
                        "description" => "Billing with 0 units MUST be moved to Unbillable activity",
                        "prevent" => $prevent[7],
                    ]);
                }
            }

            if (in_array(9, $rules)) {
                $com = $client_id . '#' . $date;
                if ($sd_dup[$com] > 1) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 9,
                        "description" => "Billing Same activity rendered in two different timing Must be Clubbed with Units",
                        "prevent" => $prevent[8],
                    ]);
                }
            }

            if (in_array(10, $rules)) {
                $h = 0.25 * $unit;
                if ($h != $hours) {
                    array_push($report, [
                        "claim_id" => $id,
                        "code" => 10,
                        "description" => "9 Codes are 15 Mins increment which for an One hour",
                        "prevent" => $prevent[9],
                    ]);
                }
            }
        }

        $result = [];
        foreach ($sc_id as $id) {
            $m_in = [];
            $m_in["claim_id"] = $id;
            $in = [];
            $i = 0;
            $pre = 2;
            foreach ($report as $rep) {
                if ($rep["claim_id"] == $id) {
                    $in[$i]["code"] = $rep["code"];
                    $in[$i]["description"] = $rep["description"];
                    if ($rep["prevent"] == 1) {
                        $pre = 1;
                    }
                    $in[$i]["prevent"] = $rep["prevent"];
                    $i++;
                }
            }
            $m_in["error"] = $in;
            $m_in["prevent"] = $pre;
            array_push($result, $m_in);
        }
        return $result;

    }


}
