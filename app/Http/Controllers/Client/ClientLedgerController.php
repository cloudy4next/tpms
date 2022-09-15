<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ledger_list;
use App\Models\setting_cpt_code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ClientLedgerController extends Controller
{
    public function my_ledger()
    {
        $client_id = Client::where('id', Auth::user()->id)->first();
        return view('client.info.myLedger', compact('client_id'));
    }

    public function my_ledger_get_all_cpt(Request $request)
    {
        $cpt_codes = setting_cpt_code::where('admin_id', Auth::user()->admin_id)->get();
        return response()->json($cpt_codes);
    }

    public function my_ledger_get(Request $request)
    {
        $client_id = $request->client_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = Auth::user()->admin_id;


        $claim_array = [];


        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";


        if (empty($client_id) && empty($payor_id) && empty($reportrange)) {


        }


        if (isset($client_id)) {
            $query .= "AND client_id =$client_id ";

        }

        if (isset($cpt)) {
            $query .= "AND cpt ='$cpt' ";
        }

        if (isset($fil_cat_name)) {
            $query .= "AND category_name ='$fil_cat_name' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$from_date' ";
            $query .= "AND schedule_date <= '$to_date' ";

        }

        $query .= "ORDER BY schedule_date ASC";
        $query_exe = DB::select($query);

        $legder_data = $this->arrayPaginatorClientLed($query_exe, $request);
        $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')
            ->where('client_id', $client_id)
            ->get();

        return response()->json([
            'notices' => $legder_data,
            'view' => View::make('client.info.include.clientLedgerTbl', compact('legder_data'))->render(),
            'pagination' => (string)$legder_data->links(),
            'is_view' => 1,
        ]);
    }


    public function my_ledger_get_next(Request $request)
    {
        $client_id = $request->client_id;
        $cpt = $request->cpt;
        $fil_cat_name = $request->fil_cat_name;

        $reportrange = $request->reportrange;
        $reportrange1 = Carbon::parse(substr($request->reportrange, 0, 10))->format('Y-m-d');
        $reportrange2 = Carbon::parse(substr($request->reportrange, 12, 22))->format('Y-m-d');


        $from_date = Carbon::parse($reportrange1)->format('Y-m-d');
        $to_date = Carbon::parse($reportrange2)->format('Y-m-d');
        $admin_id = Auth::user()->admin_id;


        $claim_array = [];


        $query = "SELECT * FROM ledger_lists WHERE admin_id=$admin_id ";


        if (empty($client_id) && empty($payor_id) && empty($reportrange)) {


        }


        if (isset($client_id)) {
            $query .= "AND client_id =$client_id ";

        }

        if (isset($cpt)) {
            $query .= "AND cpt ='$cpt' ";
        }

        if (isset($fil_cat_name)) {
            $query .= "AND category_name ='$fil_cat_name' ";
        }

        if (isset($reportrange)) {
            $query .= "AND schedule_date >= '$from_date' ";
            $query .= "AND schedule_date <= '$to_date' ";

        }

        $query .= "ORDER BY schedule_date ASC";
        $query_exe = DB::select($query);

        $legder_data = $this->arrayPaginatorClientLed($query_exe, $request);
        $ledger_list_data = ledger_list::distinct()->select('batching_id', 'client_id', 'appointment_id', 'schedule_date')
            ->where('client_id', $client_id)
            ->get();

        return response()->json([
            'notices' => $legder_data,
            'view' => View::make('client.info.include.clientLedgerTbl', compact('legder_data'))->render(),
            'pagination' => (string)$legder_data->links(),
            'is_view' => 1,
        ]);
    }


    public function arrayPaginatorClientLed($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


}
