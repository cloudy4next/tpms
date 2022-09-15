<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProviderController extends Controller
{
    public function get_provider()
    {
        $get_providers = Employee::select('id', 'first_name', 'middle_name', 'last_name', 'staff_birthday', 'ssn', 'staff_other_id', 'office_phone', 'office_fax', 'office_email')
            ->where('admin_id', Auth::user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'admin providers get',
            'clients' => $get_providers,
        ]);

    }


    public function get_provider_by_id($id)
    {
        $get_providers = Employee::select('id', 'first_name', 'middle_name', 'last_name', 'staff_birthday', 'ssn', 'staff_other_id', 'office_phone', 'office_fax', 'office_email')
            ->where('admin_id', Auth::user()->id)
            ->where('id', $id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'admin providers by id',
            'clients' => $get_providers,
        ]);
    }

}
