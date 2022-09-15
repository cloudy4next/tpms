<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ClientSessionController extends Controller
{
    public function get_my_sessions(Request $request)
    {
        $search_by = $request->search_by;
        $reportrange = $request->reportrange;

        $reportrange_one1 = Carbon::parse(substr($reportrange, 0, 10))->format('Y-m-d');
        $reportrange_one2 = Carbon::parse(substr($reportrange, 13, 24))->format('Y-m-d');


        $admin_id = Auth::user()->admin_id;
        $client_id = Auth::user()->id;

        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDay(1)->format('Y-m-d');
        $last_dat = Carbon::now()->subDay(1)->format('Y-m-d');
        $next_sev_days = Carbon::now()->addDays(7)->format('Y-m-d');
        $last_15_days = Carbon::now()->subDays(15)->format('Y-m-d');
        $next_15_days = Carbon::now()->addDays(15)->format('Y-m-d');
        $last_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $next_30_days = Carbon::now()->addDays(30)->format('Y-m-d');


        $query = "SELECT * FROM appoinments WHERE admin_id=$admin_id AND client_id=$client_id ";

        if (isset($search_by) && $search_by == 1) {
            $query .= "AND schedule_date='$today'";
        }

        if (isset($search_by) && $search_by == 2) {
            $query .= "AND schedule_date='$tomorrow'";
        }

        if (isset($search_by) && $search_by == 3) {
            $query .= "AND schedule_date='$last_dat'";
        }

        if (isset($search_by) && $search_by == 4) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_sev_days'";
        }


        if (isset($search_by) && $search_by == 5) {
            $query .= "AND schedule_date >= '$reportrange_one1'";
            $query .= "AND schedule_date <= '$reportrange_one2'";
        }

        if (isset($search_by) && $search_by == 7) {
            $query .= "AND schedule_date <= '$today'";
            $query .= "AND schedule_date >= '$last_15_days'";
        }

        if (isset($search_by) && $search_by == 8) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_15_days'";
        }


        if (isset($search_by) && $search_by == 9) {
            $query .= "AND schedule_date <= '$today'";
            $query .= "AND schedule_date >= '$last_30_days'";
        }

        if (isset($search_by) && $search_by == 10) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_30_days'";
        }


        $query .= "ORDER BY schedule_date DESC";
        $appoientment = DB::select($query);

        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('client.include.manage_session_table', compact('sessions'))->render(),
            'pagination' => (string)$sessions->links()
        ]);


    }


    public function get_my_sessions_next(Request $request)
    {
        $search_by = $request->search_by;
        $reportrange = $request->reportrange;

        $reportrange_one1 = Carbon::parse(substr($reportrange, 0, 10))->format('Y-m-d');
        $reportrange_one2 = Carbon::parse(substr($reportrange, 13, 24))->format('Y-m-d');


        $admin_id = Auth::user()->admin_id;
        $client_id = Auth::user()->id;

        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDay(1)->format('Y-m-d');
        $last_dat = Carbon::now()->subDay(1)->format('Y-m-d');
        $next_sev_days = Carbon::now()->addDays(7)->format('Y-m-d');
        $last_15_days = Carbon::now()->subDays(15)->format('Y-m-d');
        $next_15_days = Carbon::now()->addDays(15)->format('Y-m-d');
        $last_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $next_30_days = Carbon::now()->addDays(30)->format('Y-m-d');

        $query = "SELECT * FROM appoinments WHERE admin_id=$admin_id AND client_id=$client_id ";

        if (isset($search_by) && $search_by == 1) {
            $query .= "AND schedule_date='$today'";
        }

        if (isset($search_by) && $search_by == 2) {
            $query .= "AND schedule_date='$tomorrow'";
        }

        if (isset($search_by) && $search_by == 3) {
            $query .= "AND schedule_date='$last_dat'";
        }

        if (isset($search_by) && $search_by == 4) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_sev_days'";
        }


        if (isset($search_by) && $search_by == 5) {
            $query .= "AND schedule_date >= '$reportrange_one1'";
            $query .= "AND schedule_date <= '$reportrange_one2'";
        }

        if (isset($search_by) && $search_by == 7) {
            $query .= "AND schedule_date <= '$today'";
            $query .= "AND schedule_date >= '$last_15_days'";
        }

        if (isset($search_by) && $search_by == 8) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_15_days'";
        }


        if (isset($search_by) && $search_by == 9) {
            $query .= "AND schedule_date <= '$today'";
            $query .= "AND schedule_date >= '$last_30_days'";
        }

        if (isset($search_by) && $search_by == 10) {
            $query .= "AND schedule_date >= '$today'";
            $query .= "AND schedule_date <= '$next_30_days'";
        }


        $query .= "ORDER BY schedule_date DESC";
        $appoientment = DB::select($query);

        $sessions = $this->arrayPaginator($appoientment, $request);
        return response()->json([
            'notices' => $sessions,
            'view' => View::make('client.include.manage_session_table', compact('sessions'))->render(),
            'pagination' => (string)$sessions->links()
        ]);

    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

}
