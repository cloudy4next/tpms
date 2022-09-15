<?php

namespace App\Http\Controllers\Mainadmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\admin_page_access;
use App\Models\all_page;
use App\Models\Compnay;
use App\Models\Employee;
use App\Models\setting_name_location;
use App\Models\Treatment_facility;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class MainAdminAccessController extends Controller
{
    public function provider_access()
    {
        return view('mainadmin.access.providerAccess');
    }

    public function provider_create()
    {
        return view('mainadmin.access.providerCreate');
    }


    public function provider_user_remove()
    {
        return view('mainadmin.access.providerUserRemove');
    }


    public function provider_remove_get_all_admin(Request $request)
    {
        $admins = Admin::where('is_up_admin', 1)->get();
        return response()->json($admins, 200);
    }

    public function provider_by_admin(Request $request)
    {
        $admin_id = $request->admin_id;
        $query = "SELECT * FROM employees WHERE admin_id=$admin_id ";
        $query_exe = DB::select($query);
        $providers = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $providers,
            'view' => View::make('mainadmin.access.include.removeProviderTable', compact('providers'))->render(),
            'pagination' => (string)$providers->links()
        ]);
    }


    public function provider_by_admin_get(Request $request)
    {
        $admin_id = $request->admin_id;
        $query = "SELECT * FROM employees WHERE admin_id=$admin_id ";
        $query_exe = DB::select($query);
        $providers = $this->arrayPaginator($query_exe, $request);
        return response()->json([
            'notices' => $providers,
            'view' => View::make('mainadmin.access.include.removeProviderTable', compact('providers'))->render(),
            'pagination' => (string)$providers->links()
        ]);
    }


    public function provider_delete_by_admin(Request $request)
    {
        $provider_delete = Employee::where('id', $request->provid)->first();
        if ($provider_delete) {
            $provider_delete->delete();
        }

        return response()->json('done', 200);

    }


    public function admin_access()
    {

        return view('mainadmin.adminaccess.adminAccess');
    }


    public function admin_access_get_facility(Request $request)
    {
        $all_facility_names = setting_name_location::orderBy('id', 'desc')->get();
        return response()->json($all_facility_names, 200);
    }


    public function admin_access_get_adminbyfac(Request $request)
    {
        $setting_locations = setting_name_location::where('facility_name', $request->fac_id)->get();

        $array = [];
        foreach ($setting_locations as $loc) {
            array_push($array, $loc->admin_id);
        }

        $admins = Admin::whereIn('id', $array)->get();
        $sub_admin_array = [];
        foreach ($admins as $admin) {
            $check_sub_admin = Admin::where('up_admin_id', $admin->id)->first();
            if ($check_sub_admin) {
                array_push($sub_admin_array, $check_sub_admin);
            }
        }

        return response()->json([
            'admins' => $admins,
            'subadmins' => $sub_admin_array,
        ], 200);
    }


    public function admin_access_sortbyadmin(Request $request)
    {
        if ($request->sort_user == 1) {
            $admin = Admin::select('id', 'name', 'is_up_admin')->where('is_up_admin', 1)->orderBy('name', 'asc')->get();
        } elseif ($request->sort_user == 2) {
            $admin = Admin::select('id', 'name', 'is_up_admin')->where('is_up_admin', 2)->orderBy('name', 'asc')->get();
        }

        return response()->json($admin, 200);
    }


    public function admin_access_check(Request $request)
    {

        $check_admin_page = admin_page_access::where('admin_id', $request->admin_id)->get();
        $array = [];
        foreach ($check_admin_page as $page) {
            array_push($array, $page->page_id);
        }

        $get_pages = all_page::whereNotIn('id', $array)->get();
        return response()->json($get_pages, 200);


    }


    public function admin_access_get(Request $request)
    {
        $access_page = admin_page_access::where('admin_id', $request->admin_id)->get();
        return response()->json($access_page, 200);
    }


    public function admin_page_access_add(Request $request)
    {
        $pages = $request->all_page;

        foreach ($pages as $page) {
            $single_page = all_page::where('id', $page)->first();
            if ($single_page) {
                admin_page_access::create([
                    'admin_id' => $request->admin_id,
                    'page_id' => $single_page->id,
                    'page_name' => $single_page->page_name,
                    'page_url' => $single_page->page_url,
                ]);
            }

        }

        return response()->json('page_added', 200);


    }


    public function admin_page_access_remove(Request $request)
    {
        $pages = $request->allocate_page;
        foreach ($pages as $page) {
            $acces_page = admin_page_access::where('id', $page)->where('admin_id', $request->admin_id)->first();
            if ($acces_page) {
                $acces_page->delete();
            }
        }

        return response()->json('page_remove', 200);

    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 15;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


}
