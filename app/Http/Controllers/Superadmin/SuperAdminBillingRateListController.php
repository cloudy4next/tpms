<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\all_sub_activity;
use App\Models\Client_authorization_activity;
use App\Models\Payor_facility;
use App\Models\rate_list;
use App\Models\setting_cpt_code;
use App\Models\setting_service;
use App\Models\Treatment_facility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SuperAdminBillingRateListController extends Controller
{

    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->is_up_admin==1){
                $this->admin_id=Auth::user()->id;
            }
            else{
                $this->admin_id=Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }


    public function billing_rate_list()
    {
        $payors = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        
        return view('superadmin.ratelist.rateList', compact('payors'));
    }

    public function billing_rate_list_add($id)
    {

        $payors = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        $cpt_cores = setting_service::where('admin_id', $this->admin_id)->get();
        $tratments = Treatment_facility::where('admin_id', $this->admin_id)->orderBy('treatment_name','asc')->get();
        $sub_acts = all_sub_activity::where('admin_id', $this->admin_id)->orderBy('sub_activity','asc')->get();
        $p_id = $id;

        return view('superadmin.ratelist.rateListAdd', compact('payors', 'cpt_cores', 'tratments', 'sub_acts', 'p_id'));
    }

    public function billing_rate_list_back($id)
    {
        $payors = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        $back_payor = $id;

        return view('superadmin.ratelist.rateListBack', compact('payors', 'back_payor'));
    }


    public function billing_rate_list_save(Request $request)
    {
        $rate_list = new rate_list();

        $payor = Payor_facility::where('payor_id', $request->payor_id)->first();

        if ($request->hasFile('payor_file')) {
            @unlink($payor->payor_file);
            $image = $request->file('payor_file');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/payorfile/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $payor->payor_file = $imageUrl;
            $payor->save();
        }


        $rate_list->admin_id = $this->admin_id;
        $rate_list->is_up_admin = Auth::user()->is_up_admin == 1 ? 1 : 2;
        $rate_list->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        $rate_list->payor_id = $request->payor_id;
        $rate_list->treatment_type = $request->treatment_type;
        $rate_list->activity_type = $request->activity_type;
        $rate_list->sub_activity = $request->sub_activity;
        $rate_list->cpt_code = $request->cpt_code;
        $rate_list->m1 = $request->m1;
        $rate_list->m2 = $request->m2;
        $rate_list->m3 = $request->m3;
        $rate_list->m4 = $request->m4;
        $rate_list->rate_type = $request->rate_type;
        $rate_list->rate_per = $request->rate_per;
        $rate_list->contracted_rate = $request->contracted_rate;
        $rate_list->billed_rate = $request->billed_rate;
        $rate_list->increasing_percentage = $request->increasing_percentage;
        $rate_list->active = $request->active;
        $rate_list->add_auth = $request->add_auth;
        $rate_list->degree_level = $request->degree_level;
        $rate_list->save();

//        return redirect(route('superadmin.billing.ratelist'))->with('success', 'Rate List Successfully Created');
        return response()->json('done', 200);

    }

    public function billing_rate_list_edit($id)
    {
        $payors = Payor_facility::where('admin_id', $this->admin_id)->orderBy('payor_name','asc')->get();
        $cpt_cores = setting_service::where('admin_id', $this->admin_id)->get();
        $tratments = Treatment_facility::where('admin_id', $this->admin_id)->orderBy('treatment_name','asc')->get();
        $sub_acts = all_sub_activity::where('admin_id', $this->admin_id)->orderBy('sub_activity','asc')->get();
        $rate = rate_list::where('id', $id)->where('admin_id', $this->admin_id)->first();

        return view('superadmin.ratelist.rateListEdit', compact('payors', 'cpt_cores', 'rate', 'tratments', 'sub_acts'));
    }


    public function billing_rate_list_update(Request $request)
    {

        $rate_list = rate_list::where('id', $request->update_rate_id)
            ->where('admin_id', $this->admin_id)
            ->first();

        $payor = Payor_facility::where('payor_id', $request->payor_id)->first();

        if ($request->hasFile('payor_file')) {
            @unlink($payor->payor_file);
            $image = $request->file('payor_file');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/payorfile/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $payor->payor_file = $imageUrl;
            $payor->save();
        }


        $rate_list->payor_id = $request->payor_id;
        $rate_list->treatment_type = $request->treatment_type;
        $rate_list->activity_type = $request->activity_type;
        $rate_list->sub_activity = $request->sub_activity;
        $rate_list->cpt_code = $request->cpt_code;
        $rate_list->m1 = $request->m1;
        $rate_list->m2 = $request->m2;
        $rate_list->m3 = $request->m3;
        $rate_list->m4 = $request->m4;
        $rate_list->rate_type = $request->rate_type;
        $rate_list->rate_per = $request->rate_per;
        $rate_list->contracted_rate = $request->contracted_rate;
        $rate_list->billed_rate = $request->billed_rate;
        $rate_list->increasing_percentage = $request->increasing_percentage;
        $rate_list->active = $request->active;
        $rate_list->add_auth = $request->add_auth;
        $rate_list->degree_level = $request->degree_level;
        $rate_list->save();

//        return redirect(route('superadmin.billing.ratelist'))->with('success', 'Rate List Successfully Created');
        return response()->json('done', 200);
    }


    public function billing_rate_list_delete($id)
    {
        $rate_delete = rate_list::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $check_auth = Client_authorization_activity::where('rate_id', $rate_delete->id)->where('admin_id', $this->admin_id)->first();

        if ($check_auth) {
            return back()->with('alert', 'Rate List already active in activity');
            exit();
        }


        if ($rate_delete) {
            $rate_delete->delete();
        }
        return redirect(route('superadmin.billing.ratelist'))->with('success', 'Rate List Successfully Deleted');
    }


    public function billing_rate_list_data_get(Request $request)
    {
        $p_id = $request->p_id;
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM rate_lists WHERE admin_id=$admin_id ";

        if (isset($p_id)) {
            $query .= "AND payor_id=$p_id ";
        }

        $query_exe = DB::select($query);

        $rate_lists = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $rate_lists,
            'view' => View::make('superadmin.ratelist.include.ratelist_table', compact('rate_lists'))->render(),
            'pagination' => (string)$rate_lists->links()
        ]);
    }


    public function billing_rate_list_data_get_show(Request $request)
    {
        $p_id = $request->p_id;
        $admin_id = $this->admin_id;
        $query = "SELECT * FROM rate_lists WHERE admin_id=$admin_id ";
        if (isset($p_id)) {
            $query .= "AND payor_id=$p_id ";

        }

        $query_exe = DB::select($query);

        $rate_lists = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $rate_lists,
            'view' => View::make('superadmin.ratelist.include.ratelist_table', compact('rate_lists'))->render(),
            'pagination' => (string)$rate_lists->links()
        ]);
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 15;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    public function billing_rate_list_payor_filename_get(Request $request)
    {
        $payor = Payor_facility::where('payor_id', $request->payorid)->where('admin_id', $this->admin_id)->first();

        if ($payor) {

            if (!empty($payor->payor_file) && file_exists($payor->payor_file)) {
                $name = substr($payor->payor_file, 27);
                $download_path = public_path($payor->payor_file);
                $have_file = 1;
            } else {
                $name = "";
                $download_path = "";
                $have_file = 2;
            }

            return response()->json([
                'filename' => $name,
                'download_path' => $download_path,
                'have_file' => $have_file,
                'data' => $payor->id,
            ]);
        }
    }


    public function billing_rate_list_get_service(Request $request)
    {
        $service = setting_service::where('admin_id', $this->admin_id)->where('facility_treatment_id', $request->tx_type)->orderBy('description','asc')->get();

        return response()->json($service, 200);
    }


    public function billing_rate_list_get_subtype(Request $request)
    {
        $sub_type = all_sub_activity::where('admin_id', $this->admin_id)
            ->where('facility_treatment_id', $request->tx_type)
            ->where('service_id', $request->rate_service)
            ->orderBy('sub_activity','asc')
            ->get();
        return response()->json($sub_type, 200);
    }


    public function billing_rate_list_get_cptcode(Request $request)
    {
        $cpt_codes = setting_cpt_code::where('admin_id', $this->admin_id)->where('facility_treatment_id', $request->tx_type)->get();
        return response()->json($cpt_codes, 200);
    }


    public function billing_rate_list_file_download($id)
    {
        $payor = Payor_facility::where('id', $id)->where('admin_id', $this->admin_id)->first();
        if ($payor) {
            $path = public_path($payor->payor_file);
            return Response::download($path);
        } else {
            return back();
        }
    }


}
