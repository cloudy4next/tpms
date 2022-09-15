<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;

use App\Http\Traits\SuperAdminTrait;
use App\Jobs\UpdateAllExistAppoinment;
use App\Models\Admin;
use App\Models\admin_profile;
use App\Models\all_sub_activity;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Employee_credential;
use App\Models\manage_claim_transaction;
use App\Models\Processing_claim;
use App\Models\SuperAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Livewire\str;
use Intervention\Image\Facades\Image;


class SuperAdminController extends Controller
{
    use SuperAdminTrait;

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

    public function index()
    {
        $clients = Client::where('admin_id', $this->admin_id)
            ->where('is_active_client', 1)
            ->count();

        $active_staffs = Employee::where('admin_id', $this->admin_id)->where('is_active',1)
            ->count();

        $app_renders = Appoinment::where('admin_id', $this->admin_id)
            ->where('status', 'Scheduled')
            ->count();

        $count_manage_claims = manage_claim_transaction::select('admin_id', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->get();
        $array = [];
        foreach ($count_manage_claims as $clam) {
            array_push($array, $clam->appointment_id);
        }

        $today = Carbon::now()->format('Y-m-d');
        $count_app = Appoinment::whereNotIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->get();


        $count_process_claims = Processing_claim::select('admin_id', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->where('is_mark_gen', 0)
            ->where('status', '!=', 'Unbillable Activity')
            ->get();

        $array2 = [];
        foreach ($count_process_claims as $procc) {
            array_push($array2, $procc->appointment_id);
        }

        $count_bot_billed = Appoinment::whereIn('id', $array2)
            ->where('admin_id', $this->admin_id)
            ->orderBy('schedule_date', 'asc')
            ->get();

        return view('superadmin.index', compact('clients', 'active_staffs', 'app_renders', 'count_app', 'count_bot_billed'));
    }

    public function index2()
    {
        $clients = Client::where('admin_id', $this->admin_id)
            ->where('is_active_client', 1)
            ->count();

        $active_staffs = Employee::where('admin_id', $this->admin_id)->where('is_active',1)
            ->count();

        $app_renders = Appoinment::where('admin_id', $this->admin_id)
            ->where('status', 'Scheduled')
            ->count();

        $count_manage_claims = manage_claim_transaction::select('admin_id', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->get();
        $array = [];
        foreach ($count_manage_claims as $clam) {
            array_push($array, $clam->appointment_id);
        }

        $today = Carbon::now()->format('Y-m-d');
        $count_app = Appoinment::whereNotIn('id', $array)
            ->where('admin_id', $this->admin_id)
            ->get();


        $count_process_claims = Processing_claim::select('admin_id', 'appointment_id')
            ->where('admin_id', $this->admin_id)
            ->where('is_mark_gen', 0)
            ->where('status', '!=', 'Unbillable Activity')
            ->get();

        $array2 = [];
        foreach ($count_process_claims as $procc) {
            array_push($array2, $procc->appointment_id);
        }

        $count_bot_billed = Appoinment::whereIn('id', $array2)
            ->where('admin_id', $this->admin_id)
            ->orderBy('schedule_date', 'asc')
            ->get();

        return view('superadmin.index2', compact('clients', 'active_staffs', 'app_renders', 'count_app', 'count_bot_billed'));
    }


    public function profile()
    {
        $data = admin_profile::where('admin_id', Auth::user()->id)->first();
        if ($data) {
            return view('superadmin.profile', compact('data'));
        } else {
            $data = new admin_profile();
            $data->admin_id = Auth::user()->id;
            $data->user_name = null;
            $data->marital = null;
            $data->age = null;
            $data->city = null;
            $data->country = null;
            $data->state = null;
            $data->address = null;
            $data->profile_photo = null;
            $data->save();
            $data = admin_profile::where('admin_id', Auth::user()->id)->first();
            return view('superadmin.profile', compact('data'));
        }
    }

    public function personal_update(Request $request)
    {
        $data = admin_profile::where('admin_id', Auth::user()->id)->first();
        if ($request->hasFile('profile_photo')) {
            @unlink($data->logo);
            $image = $request->file('profile_photo');
            $ext = $request->file('profile_photo')->extension();
            $imageName = time() . uniqid() . '.' . $ext;
            $directory = 'assets/profile/';
            $imgUrl = $directory . $imageName;
            Image::make($image)->save($imgUrl);
            $data->profile_photo = $imgUrl;
        }

        $data->city = $request->city;
        $data->country = isset($request->country) ? $request->country : null;
        $data->state = isset($request->state) ? $request->state : null;
        $data->zip = $request->zip;
        $data->save();

        $data = Admin::where("id", Auth::user()->id)->first();

        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->name = $request->first_name.' '.$request->last_name;
        $data->gender = $request->gender;
        $data->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function email_update(Request $request)
    {
        $data = Admin::where('id', Auth::user()->id)->first();
        $data->email_not = $request->email_not;
        $data->sms_not = $request->sms_not;
        $data->save();

        return back()->with('success', 'Profile updated successfully!');

    }

    public function contact_update(Request $request)
    {
        $data = Admin::where('id', Auth::user()->id)->first();
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->url = $request->url;
        $data->save();

        return back()->with('success', 'Profile updated successfully!');

    }

    public function verify_password(Request $request)
    {
        $data = Admin::where('id', Auth::user()->id)->first();
        $check = Hash::check($request->current_pass, $data->password);
        if (!$check) {
            return "wrong";
        } else {
            return "correct";
        }
    }

    public function password_update(Request $request)
    {
        $data = Admin::where('id', Auth::user()->id)->first();
        $data->password = Hash::make($request->verify_pass);
        $data->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function account_chnage_password()
    {

        $flag["pass"] = "password";
        $data = admin_profile::where('admin_id', Auth::user()->id)->first();
        if ($data) {
            return view('superadmin.profile', compact('data', 'flag'));
        } else {
            $data = new admin_profile();
            $data->admin_id = Auth::user()->id;
            $data->user_name = null;
            $data->marital = null;
            $data->age = null;
            $data->city = null;
            $data->country = null;
            $data->state = null;
            $data->address = null;
            $data->profile_photo = null;
            $data->save();
            $data = admin_profile::where('admin_id', Auth::user()->id)->first();
            return view('superadmin.profile', compact('data', 'flag'));
        }

    }


    public function do_lock()
    {
        $admin = Admin::where('id', Auth::user()->id)->first();
        $admin->locked_token = Str::random(15) . rand(0000, 8888) . $admin->id . time() . uniqid();
        $admin->lockout_time = 1;
        $admin->save();

        return view('auth.userScreenLocked', compact('admin'));
    }


}
