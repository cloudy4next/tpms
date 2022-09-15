<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminClientController extends Controller
{
    public function get_clients()
    {
        $clients = Client::select('id', 'is_active_client', 'client_full_name', 'client_first_name', 'client_middle', 'client_last_name', 'client_gender', 'client_dob', 'email', 'email_type', 'phone_number')
            ->where('admin_id', Auth::user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'admin clients get',
            'clients' => $clients,
        ]);
    }


    public function get_clients_by_id($id)
    {
        $clients = Client::select('id', 'is_active_client', 'client_full_name', 'client_first_name', 'client_middle', 'client_last_name', 'client_gender', 'client_dob', 'email', 'email_type', 'phone_number')
            ->where('admin_id', Auth::user()->id)
            ->where('id', $id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'admin clients by id',
            'clients' => $clients,
        ]);
    }


    public function ac_get_clients()
    {
        $clients = Client::where('admin_id', Auth::user()->id)
            ->paginate(2);

        return response()->json([
            'status' => 'success',
            'message' => 'admin clients get',
            'clients' => $clients,
        ]);
    }

    public function ac_get_clients_by_id($id)
    {
        $clients = Client::where('admin_id', Auth::user()->id)
            ->where('id', $id)
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'admin clients by id',
            'clients' => $clients,
        ]);
    }


}
