<?php

namespace App\Http\Traits;

use App\Models\Client;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;

trait SuperAdminTrait
{
    public function Dashboard($admin_type)
    {
        if ($admin_type == 1) {
            $sub_admins = SuperAdmin::assign_admins(Auth::user()->id);
            $clients = Client::where('admin_id', Auth::user()->id)
                ->orWhere(function ($query) use ($sub_admins) {
                    $query->whereIn('admin_id', $sub_admins);
                })
                ->where('is_active_client', 1)
                ->count();
            return $clients;
        } else {
            $clients = Client::where('admin_id', Auth::user()->id)
                ->orWhere('admin_id', Auth::user()->up_admin_id)
                ->where('is_active_client', 1)
                ->count();
            return $clients;
        }
    }
}
