<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\deposit_apply_transaction;
use App\Models\patient_statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ClientStatementController extends Controller
{
    public function client_my_statement()
    {
        $clients = Client::where('id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->first();
        $copay = patient_statement::where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_paid', 0)
            ->where('is_submit',1)
            ->sum('co_pay');

        $cocoind = patient_statement::where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_paid', 0)
            ->where('is_submit',1)
            ->sum('coins');

        $ded = patient_statement::where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_paid', 0)
            ->where('is_submit',1)
            ->sum('ded');

        $total_sum = $copay + $cocoind + $ded;
        return view('client.statement.myStatement', compact('clients', 'total_sum'));
    }


    public function client_my_statement_paid(Request $request)
    {
        $client_statements = patient_statement::where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_submit',1)
            ->where('is_paid', 1)
            ->get();


        return response()->json([
            'notices' => $client_statements,
            'view' => View::make('client.statement.include.includeTable', compact('client_statements'))->render(),
        ]);


    }


    public function client_my_statement_unpaid(Request $request)
    {
        $client_statements = patient_statement::where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_submit',1)
            ->where('is_paid', 0)
            ->get();


        return response()->json([
            'notices' => $client_statements,
            'view' => View::make('client.statement.include.includeTable', compact('client_statements'))->render(),
        ]);
    }


    public function client_my_statement_get_data(Request $request)
    {
        $type = $request->related_to;

        // $dep_apply_data = deposit_apply_transaction::select('id', 'client_id', 'dos', 'activity_id', 'balance', 'status')
        //     ->where('client_id', Auth::user()->id)
        //     ->where('admin_id', Auth::user()->admin_id)
        //     ->where('status', 'PR CoIns')
        //     ->orWhere('status', 'PR Copay')
        //     ->orWhere('status', 'PR Ded')
        //     ->get();


        // foreach ($dep_apply_data as $dep_data) {
        //     $check_exists = patient_statement::select('deposit_apply_id', 'client_id')
        //         ->where('deposit_apply_id', $dep_data->id)
        //         ->where('client_id', $dep_data->client_id)
        //         ->where('admin_id', Auth::user()->id)
        //         ->first();

        //     if (!$check_exists) {
        //         $new_statement = new patient_statement();
        //         $new_statement->admin_id = Auth::user()->is_up_admin == 1 ? Auth::user()->id : Auth::user()->up_admin_id;
        //         $new_statement->down_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        //         $new_statement->dep_id = $dep_data->deposit_apply_id;
        //         $new_statement->deposit_apply_id = $dep_data->id;
        //         $new_statement->client_id = $dep_data->client_id;
        //         $new_statement->service_date = $dep_data->dos;
        //         $new_statement->activity_id = $dep_data->activity_id;
        //         $new_statement->co_pay = $dep_data->status == "PR Copay" ? $dep_data->balance : 0.00;
        //         $new_statement->coins = $dep_data->status == "PR CoIns" ? $dep_data->balance : 0.00;
        //         $new_statement->ded = $dep_data->status == "PR Ded" ? $dep_data->balance : 0.00;
        //         $new_statement->status = $dep_data->status;
        //         $new_statement->is_paid = 0;
        //         $new_statement->save();
        //     }
        // }

        $data = patient_statement::select('deposit_apply_id')->where('client_id', Auth::user()->id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('is_submit',1)
            ->where('is_paid', 1)
            ->get();

        $dep_ids=[];
        foreach($data as $dat){
            $dep = deposit_apply_transaction::select('deposit_apply_id','status')
                ->where('deposit_apply_id', $dat->deposit_apply_id)
                ->where('client_id', Auth::user()->id)
                ->where('admin_id', Auth::user()->admin_id)
                ->where('status', 'PR CoIns')
                ->orWhere('status', 'PR Copay')
                ->orWhere('status', 'PR Ded')
                ->first();

            if($dep){
                array_push($dep_ids,$dep->deposit_apply_id);
            }
        }

        $client_statements = patient_statement::whereIn('deposit_apply_id',$dep_ids)->where('client_id',Auth::user()->id)->where('admin_id',Auth::user()->admin_id)->get();

        return response()->json([
            'notices' => $client_statements,
            'view' => View::make('client.statement.include.includeTable', compact('client_statements'))->render(),
        ]);
    }


}
