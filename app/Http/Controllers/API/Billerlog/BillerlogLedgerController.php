<?php

namespace App\Http\Controllers\API\Billerlog;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\deposit_apply_transaction;
use App\Models\ledger_list;
use App\Models\ledger_note;
use App\Models\manage_claim_transaction;
use App\Models\setting_name_location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillerlogLedgerController extends Controller
{
    public function get_facility()
    {
        $name_location = setting_name_location::select('id', 'admin_id', 'facility_name')->where('admin_id', '!=', null)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'get facility',
            'facility' => $name_location
        ]);
    }


    public function get_client($fac_id)
    {
        $name_location = setting_name_location::select('id', 'admin_id')->where('id', $fac_id)->first();
        if ($name_location) {
            $clients = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $name_location->admin_id)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'get client',
                'clients' => $clients
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'client not found',
            ]);
        }
    }


    public function get_ledger_data(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'sort_by' => 'required',
            'client_id' => 'required',
        ], [
            'sort_by.required' => 'Please select sort by',
            'client_id.required' => 'Please select client',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
            exit();
        }


        $sort_by = $request->sort_by;
        $client_id = $request->client_id;
        $client = Client::select('id', 'admin_id')->where('id', $request->client_id)->first();
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $from_date = Carbon::parse($request->form_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $admin_id = $client->admin_id;


        if ($sort_by == 2) {
            $ledger_list = ledger_list::where('admin_id', $admin_id)->where('client_id', $client_id)
                ->where('schedule_date', '>=', $from_date)
                ->where('schedule_date', '<=', $to_date)
                ->where(function ($query) use ($cpt, $fil_cat_name) {
                    if (isset($cpt) && $cpt != '') {
                        $query->where('cpt', $cpt);
                    }

                    if (isset($fil_cat_name) && $fil_cat_name != '') {
                        $query->where('category_name', $fil_cat_name);
                    }
                })
                ->orderBy('schedule_date', 'asc')
                ->with(['ledger_client', 'ledger_provider', 'ledger_payor', 'manage_claim', 'deposit_apply', 'deposit_apply_paid'])
                ->paginate(20);
        } elseif ($sort_by == 2) {
            $ledger_list = [];
        } else {
            $ledger_list = [];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get ledger data',
            'leder_data' => $ledger_list,
            'count_ses' => count($ledger_list)
        ]);

    }


    public function get_ledger_tran_data(Request $request)
    {
        $ids = $request->ids;
        $arr = explode(",", $ids);

        $arr_data = [];
        foreach ($arr as $ar) {
            array_push($arr_data, $ar);
        }

        $client = Client::select('id', 'admin_id')->where('id', $request->patient_id)->first();
        $admin_id = $client->admin_id;


        $ledger_tran_datats = deposit_apply_transaction::where('admin_id', $admin_id)->whereIn('batching_claim_id', $arr_data)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'get ledger transaction data',
            'leder_data' => $ledger_tran_datats,
            'count_ses' => count($ledger_tran_datats)
        ]);

    }


    public function ledger_single_note_add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ledger_id' => 'required',
            'patient_id' => 'required',
            'category_name' => 'required',
            'followup_date' => 'required',
            'worked_date' => 'required',
            'notes' => 'required',
        ], [
            'ledger_id.required' => 'Please Enter Ledger ID',
            'patient_id.required' => 'Please Enter Patient ID',
            'category_name.required' => 'Please Enter category name',
            'followup_date.required' => 'Please Enter followup date',
            'worked_date.required' => 'Please Enter worked date',
            'notes.required' => 'Please Enter notes',
        ]);


        $client = Client::select('id', 'admin_id')->where('id', $request->patient_id)->first();
        $admin_id = $client->admin_id;

        $led_data = ledger_list::where('id', $request->ledger_id)->where('admin_id', $admin_id)->first();

        if ($led_data) {
            $new_note = new ledger_note();
            $new_note->admin_id = $admin_id;
            $new_note->ledger_id = $request->ledger_id;
            $new_note->client_id = $client->id;
            $new_note->payor_id = $led_data->payor_id;
            $new_note->cpt_code = $led_data->cpt;
            $new_note->category_name = $request->category_name;
            $new_note->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
            $new_note->worked_date = $request->worked_date;
            $new_note->notes = $request->notes;
            $new_note->save();

            $led_data->category_name = $request->category_name;
            $led_data->followup_date = Carbon::parse($request->followup_date)->format('Y-m-d');
            $led_data->worked_date = Carbon::now()->format('Y-m-d');
            $led_data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'ledger single note successfully added',
            ]);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'ledger not found',
            ]);
        }
    }


    public function ledger_note_get(Request $request)
    {
        $client = Client::select('id', 'admin_id')->where('id', $request->patient_id)->first();
        $admin_id = $client->admin_id;
        $comments = DB::table('ledger_notes')
            ->where('admin_id', $admin_id)
            ->where('ledger_id', $request->ledger_id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'ledger notes',
            'ledger_notes' => $comments,
        ]);
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 30;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


}
