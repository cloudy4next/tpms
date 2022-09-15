<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Mail\ProviderAccessEmail;
use App\Mail\StaffResetPassword;
use App\Models\All_payor;
use App\Models\all_sub_activity;
use App\Models\Client;
use App\Models\Admin;
use App\Models\Client_activity;
use App\Models\Employee;
use App\Models\Employee_clearance;
use App\Models\Employee_client_exclusion;
use App\Models\Employee_contact_detail;
use App\Models\Employee_credential;
use App\Models\Employee_department;
use App\Models\Employee_details_tx_type;
use App\Models\Employee_emergency_contact_detail;
use App\Models\Employee_exclude_payor;
use App\Models\Employee_hr_note;
use App\Models\Employee_leave;
use App\Models\Employee_other_setup;
use App\Models\Employee_payor_exclusion;
use App\Models\Employee_payroll;
use App\Models\employee_portal_feature;
use App\Models\Employee_qualification;
use App\Models\Employee_subactivity_exclusion;
use App\Models\Employee_type_assign;
use App\Models\payor_details_tx_type;
use App\Models\portal_access_email;
use App\Models\setting_service;
use App\Models\SuperAdmin;
use App\Models\Treatment_facility;
use App\Models\reset_password_link;
use App\Models\point_of_service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminEmployeeController extends Controller
{
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

    public function employee()
    {
        return view('superadmin.employee.employeeList');
    }


    public function employee_get(Request $request)
    {
        $name = $request->name;
        $search_phone = $request->search_phone;
        $search_email = $request->search_email;
        $search_language = $request->search_language;


        $admin_id = $this->admin_id;

        $query = "SELECT * FROM employees WHERE admin_id IS NOT NULL ";
        $query .= "AND admin_id=$admin_id ";

        if (empty($name) && empty($search_phone) && empty($search_email) && empty($search_language)) {
        }

        if (isset($name)) {
            $query .= "AND full_name LIKE '%$name%'";
        }

        if (isset($search_phone)) {
            $query .= "AND office_phone LIKE '%$name%'";
        }

        if (isset($search_language)) {
            $query .= "AND language LIKE '%$name%'";
        }

        if (isset($request->search_status)) {
            if($request->search_status == 2){
                $query .= "AND is_active = 1";
            }
            else if($request->search_status == 3){
                $query .= "AND is_active <> 1";
            }
        }

        $employee_lists = DB::select($query);

        // $employee_lists = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $employee_lists,
            'view' => View::make('superadmin.employee.include.employeelistinc', compact('employee_lists'))->render(),
            // 'pagination' => (string)$employee_lists->links(),
            'data_type' => 1
        ]);
    }

    public function employee_get_filter(Request $request)
    {
        $name = $request->name;
        $search_phone = $request->search_phone;
        $search_email = $request->search_email;
        $search_language = $request->search_language;


        $admin_id = $this->admin_id;

        $query = "SELECT * FROM employees WHERE admin_id IS NOT NULL ";
        $query .= "AND admin_id=$admin_id ";
        if (isset($name)) {
            $query .= "AND full_name LIKE '%$name%'";
        }

        if (isset($search_phone)) {
            $query .= "AND office_phone LIKE '%$name%'";
        }

        if (isset($search_language)) {
            $query .= "AND language LIKE '%$name%'";
        }

        if (isset($request->search_status)) {
            if($request->search_status == 2){
                $query .= "AND is_active = 1";
            }
            else if($request->search_status == 3){
                $query .= "AND is_active <> 1";
            }
        }
        
        $query_exe = DB::select($query);

        $employee_lists = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $employee_lists,
            'view' => View::make('superadmin.employee.include.employeelistinc', compact('employee_lists'))->render(),
            'pagination' => (string)$employee_lists->links(),
            'data_type' => 1
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


    public function employee_get_active_update(Request $request)
    {
        $employee = Employee::where('id', $request->employee_id)->first();
        $employee->is_active = $request->is_active;
        $employee->save();
        return response()->json('done', 200);
    }


    public function employee_create($employee_type)
    {
        $employee = $employee_type;
        $employee_staff_type = Employee_type_assign::where('admin_id', $this->admin_id)->get();

        return view('superadmin.employee.employeeCreate', compact('employee', 'employee_staff_type'));
    }


    public function employee_save(Request $request)
    {
        $name = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
        $check_exists_staff = Employee::where('full_name', $name)->where('admin_id', $this->admin_id)->first();

        if ($check_exists_staff) {
            return back()->with('alert', 'Already have staff with same name');
            exit();
        }


        $new_employee = new employee();
        $new_employee->admin_id = $this->admin_id;
        $new_employee->is_active = 1;
        $new_employee->up_admin_id = Auth::user()->is_up_admin == 1 ? 0 : Auth::user()->id;
        $new_employee->employee_type = $request->employee_type;
        $new_employee->employee_id = Str::random(5) . rand(11, 99);
        $new_employee->first_name = $request->first_name;
        $new_employee->middle_name = $request->middle_name;
        $new_employee->last_name = $request->last_name;
        $new_employee->full_name = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
        $new_employee->nickname = $request->nickname;
        $new_employee->staff_birthday = $request->staff_birthday;
        $new_employee->ssn = $request->ssn;
        $new_employee->staff_other_id = $request->staff_other_id;
        $new_employee->office_phone = $request->office_phone;
        $new_employee->office_fax = $request->office_fax;
        $new_employee->office_email = $request->office_email;
        $new_employee->driver_license = $request->driver_license;
        $new_employee->license_exp_date = $request->license_exp_date;
        $new_employee->title = $request->title;
        $new_employee->hir_date_compnay = $request->hir_date_compnay;
        $new_employee->credential_type = $request->credential_type;
        $new_employee->treatment_type = $request->treatment_type;
        $new_employee->individual_npi = $request->individual_npi;
        $new_employee->caqh_id = $request->caqh_id;
        $new_employee->service_area_zip = $request->service_area_zip;
        $new_employee->terminated_date = $request->terminated_date;
        $new_employee->language = $request->language;
        $new_employee->taxonomy_code = $request->taxonomy_code;
        $new_employee->gender = $request->gender;
        $new_employee->back_color = $request->back_color;
        $new_employee->text_color = $request->text_color;
        $new_employee->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Created",
            'message' => " Staff Created ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);


        return redirect(route('superadmin.employee'))->with('success', 'Employee Successfully Created');
    }

    public function employee_biographic($id)
    {


        $employee = employee::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $assign_type = Employee_type_assign::where('admin_id', $this->admin_id)->get();
        $tx_types = Treatment_facility::where('admin_id', $this->admin_id)->orderBy('treatment_name', 'asc')->get();
        $employee_staff_type = Employee_type_assign::where('admin_id', $this->admin_id)->get();

        $employee_credn = Employee_credential::where('employee_id', $id)->get();

        return view('superadmin.employee.employeeEdit', compact('employee', 'assign_type', 'tx_types', 'employee_credn', 'employee_staff_type'));
    }

    public function employee_biographic_update(Request $request)
    {
        if ($request->office_email != null && $request->office_email != '') {
            $email_check = $this->existing_email_check($request->employee_edit_id, $request->office_email);
            if ($email_check == "fail") {
                return back()->with("alert", $request->office_email . " already exists.");
            }
        }

        $session_check = isset($request->session_check) && ($request->session_check == 1) ? $request->session_check : 2;
        $employe_bio_update = employee::where('id', $request->employee_edit_id)->where('admin_id', $this->admin_id)->first();

        $employe_bio_update->first_name = $request->first_name;
        $employe_bio_update->middle_name = $request->middle_name;
        $employe_bio_update->last_name = $request->last_name;
        $employe_bio_update->full_name = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
        $employe_bio_update->nickname = $request->nickname;
        $employe_bio_update->staff_birthday = $request->staff_birthday;
        $employe_bio_update->ssn = $request->ssn;
        $employe_bio_update->staff_other_id = $request->staff_other_id;
        $employe_bio_update->office_phone = $request->office_phone;
        $employe_bio_update->office_fax = $request->office_fax;
        $employe_bio_update->office_email = $request->office_email;
        $employe_bio_update->driver_license = $request->driver_license;
        $employe_bio_update->license_exp_date = $request->license_exp_date;
        $employe_bio_update->title = $request->title;
        $employe_bio_update->hir_date_compnay = $request->hir_date_compnay;
        $employe_bio_update->credential_type = $request->credential_type;
        $employe_bio_update->treatment_type = $request->treatment_type;
        $employe_bio_update->individual_npi = $request->individual_npi;
        $employe_bio_update->caqh_id = $request->caqh_id;
        $employe_bio_update->service_area_zip = $request->service_area_zip;
        $employe_bio_update->terminated_date = $request->terminated_date;
        $employe_bio_update->language = $request->language;
        $employe_bio_update->taxonomy_code = $request->taxonomy_code;
        $employe_bio_update->gender = $request->gender;
        $employe_bio_update->military_service = $request->military_service;
        $employe_bio_update->therapist_bill = $request->therapist_bill;
        $employe_bio_update->is_staff_active = $request->is_staff_active;
        $employe_bio_update->enable_fource_creation = $request->enable_fource_creation;
        $employe_bio_update->has_catalsty_access = $request->has_catalsty_access;
        $employe_bio_update->notes = $request->notes;
        $employe_bio_update->back_color = $request->back_color;
        $employe_bio_update->text_color = $request->text_color;
        $employe_bio_update->session_check = $session_check;
        $employe_bio_update->save();

        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Updated",
            'message' => " Staff Updated ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Successfully Updated');
    }

    private function existing_email_check($user_id, $email)
    {
        $email_check = Admin::select('id')->where('email', $email)->first();
        if ($email_check) {
            return "fail";
        } else {
            $email_check = Employee::select('id')->where('id', '!=', $user_id)->where(function ($q) use ($email) {
                $q->where('office_email', $email)->orWhere('login_email', $email);
            })->first();
            if ($email_check) {
                return "fail";
            } else {
                $email_check = Client::select('id')->where(function ($q) use ($email) {
                    $q->where('email', $email)->orWhere('login_email', $email);
                })->first();
                if ($email_check) {
                    return "fail";
                } else {
                    return "pass";
                }
            }
        }
    }
    public function employee_contact_details($id)
    {
        $employee_name = Employee::where('id', $id)->first();
        $exist_employee = Employee_contact_detail::where('employee_id', $id)->first();
        $exist_employee_em = Employee_emergency_contact_detail::where('employee_id', $id)->first();

        if ($exist_employee) {
            $employee = $exist_employee;
        } else {
            $employee = new employee_contact_detail();
            $employee->employee_id = $id;
            $employee->save();
        }


        if ($exist_employee_em) {
            $employee_em = $exist_employee_em;
        } else {
            $employee_em = new employee_emergency_contact_detail();
            $employee_em->employee_id = $id;
            $employee_em->save();
        }

        return view('superadmin.employee.employeeContactDetails', compact('employee_name', 'employee', 'employee_em'));
    }


    public function employee_contact_details_update(Request $request)
    {
        $employe_contact_update = employee_contact_detail::where('employee_id', $request->employee_contact_edit)->first();
        $employe_contact_update->address_one = $request->address_one;
        $employe_contact_update->address_two = $request->address_two;
        $employe_contact_update->city = $request->city;
        $employe_contact_update->state = $request->state;
        $employe_contact_update->zip = $request->zip;
        $employe_contact_update->mobile = $request->mobile;
        $employe_contact_update->fax = $request->fax;
        $employe_contact_update->main_phone = $request->main_phone;
        $employe_contact_update->address_note = $request->address_note;
        $employe_contact_update->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Contact Details Updated",
            'message' => " Staff Contact Details Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Contact Details Successfully Updated');
    }

    public function employee_emergency_contact_details_update(Request $request)
    {
        $employe_em_contact_update = employee_emergency_contact_detail::where('employee_id', $request->em_contact_update)->first();
        $employe_em_contact_update->contact_name = $request->em_contact_name;
        $employe_em_contact_update->address_one = $request->em_address_one;
        $employe_em_contact_update->address_two = $request->em_address_two;
        $employe_em_contact_update->city = $request->em_city;
        $employe_em_contact_update->state = $request->em_state;
        $employe_em_contact_update->zip = $request->em_zip;
        $employe_em_contact_update->mobile = $request->em_mobile;
        $employe_em_contact_update->fax = $request->em_fax;
        $employe_em_contact_update->main_phone = $request->em_main_phone;
        $employe_em_contact_update->address_note = $request->em_address_note;
        $employe_em_contact_update->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Emergency Contact Details Updated",
            'message' => " Staff Emergency Contact Details Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Emergency Contact Details Successfully Updated');
    }


    public function employee_credentials($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();

        $cred_lists = Employee_credential::where('employee_id', $id)->paginate(10);
        $clen_lists = Employee_clearance::where('employee_id', $id)->paginate(10);
        $qua_lists = Employee_qualification::where('employee_id', $id)->paginate(10);
        return view('superadmin.employee.employeeCredentials', compact('employee', 'cred_lists', 'clen_lists', 'qua_lists'));
    }


    public function employee_credentials_save(Request $request)
    {
        $new_employee_credentials = new employee_credential();
        if ($request->hasFile('cred_file')) {
            $image = $request->file('cred_file');
            $name = time() . $request->employee_id . $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/staffdocument/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $new_employee_credentials->credential_file = $imageUrl;
        }

        $new_employee_credentials->employee_id = $request->employee_id;
        $new_employee_credentials->credential_name = $request->cred_type;
        $new_employee_credentials->credential_date_issue = $request->date_issue;
        $new_employee_credentials->credential_date_expired = $request->date_expire;
        $new_employee_credentials->credential_applicable = $request->cred_apply;
        $new_employee_credentials->save();

        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Credential Created",
            'message' => " Staff Credential Created",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);


        return back()->with('success', 'Employee Credentials Successfully Created');
    }

    public function employee_credentials_update(Request $request)
    {
        $data = employee_credential::where('id', $request->cred_id)->first();
        if ($request->hasFile('cred_file')) {
            $image = $request->file('cred_file');
            $name = time() . $request->employee_id . $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/staffdocument/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $data->credential_file = $imageUrl;
        }
        $data->credential_name = $request->cred_type;
        $data->credential_date_issue = $request->date_issue;
        $data->credential_date_expired = $request->date_expire;
        $data->credential_applicable = $request->cred_apply;
        $data->save();

        return back()->with('success', 'Employee Credentials Updated Successfully!');
    }

    public function employee_credentials_delete(Request $request)
    {
        $data = employee_credential::where('id', $request->id)->delete();

        return back()->with('success', 'Employee Credentials Deleted Successfully!');
    }

    public function employee_clearance_save(Request $request)
    {
        $data = new employee_clearance();

        if ($request->hasFile('clear_file')) {
            $image = $request->file('clear_file');
            $name = time() . $request->employee_id . $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/staffdocument/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $data->clearance_file = $imageUrl;
        }

        $data->employee_id = $request->employee_id;
        $data->clearance_name = $request->clear_type;
        $data->clearance_date_issue = $request->date_issue;
        $data->clearance_date_exp = $request->date_expire;
        $data->clearance_applicable = $request->clear_apply;
        $data->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Clearance Created",
            'message' => " Staff Clearance Created",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Clearance Successfully Created');
    }

    public function employee_clearance_update(Request $request)
    {
        $data = employee_clearance::where('id', $request->clear_id)->first();

        if ($request->hasFile('clear_file')) {
            $image = $request->file('clear_file');
            $name = time() . $request->employee_id . $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/staffdocument/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $data->clearance_file = $imageUrl;
        }

        $data->clearance_name = $request->clear_type;
        $data->clearance_date_issue = $request->date_issue;
        $data->clearance_date_exp = $request->date_expire;
        $data->clearance_applicable = $request->clear_apply;
        $data->save();
        return back()->with('success', 'Employee Clearance Updated Successfully!');
    }

    public function employee_clearance_delete(Request $request)
    {
        $data = employee_clearance::where('id', $request->id)->delete();
        return back()->with('success', 'Employee Clearance Deleted Successfully!');
    }


    public function employee_qualification_save(Request $request)
    {
        $data = new employee_qualification();

        if ($request->hasFile('qualification_file')) {
            $image = $request->file('qualification_file');
            $name = time() . $request->employee_id . $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/staffdocument/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $data->qualification_file = $imageUrl;
        }

        $data->employee_id = $request->employee_id;
        $data->qualification_name = $request->qual_type;
        $data->qualification_date_issue = $request->date_issue;
        $data->qualification_date_exp = $request->date_expire;
        $data->qualification_applicable = $request->qual_apply;
        $data->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Qualification Created",
            'message' => " Staff Qualification Created",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Qualification Successfully Created');
    }

    public function employee_qualification_update(Request $request)
    {
        $data = employee_qualification::where('id', $request->qual_id)->first();
        $data->qualification_name = $request->qual_type;
        $data->qualification_date_issue = $request->date_issue;
        $data->qualification_date_exp = $request->date_expire;
        $data->qualification_applicable = $request->qual_apply;
        $data->save();
        return back()->with('success', 'Employee Qualification Updated Successfully!');
    }

    public function employee_qualification_delete(Request $request)
    {
        $data = employee_qualification::where('id', $request->id)->delete();
        return back()->with('success', 'Employee Qualification Deleted Successfully!');
    }

    public function employee_department($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();


        $exist_dep_a = Employee_department::where('employee_id', $id)->first();
        if ($exist_dep_a) {
            $exist_dep = $exist_dep_a;
        } else {
            $exist_dep = new employee_department();
            $exist_dep->admin_id = $this->admin_id;
            $exist_dep->employee_id = $id;
            $exist_dep->save();
        }

        $clients = Employee::where('admin_id', $this->admin_id)->get();
        return view('superadmin.employee.employeeDepartment', compact('employee', 'exist_dep', 'clients'));
    }

    public function employee_department_save(Request $request)
    {
        $update_emp_dep = employee_department::where('employee_id', $request->employee_dep_id)->first();
        $update_emp_dep->admin_id = $this->admin_id;
        $update_emp_dep->is_supervisor = $request->is_supervisor;
        $update_emp_dep->supervisor_id = $request->supervisor_id;
        $update_emp_dep->save();

        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Department Created",
            'message' => " Staff Department Created",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Department Successfully Created');
    }


    public function employee_payroll($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $em_payrols = Employee_payroll::where('employee_id', $id)->paginate(10);
        $all_service = setting_service::where('admin_id', $this->admin_id)->get();


        return view('superadmin.employee.employeePayroll', compact('employee', 'em_payrols', 'all_service'));
    }

    public function employee_payroll_save(Request $request)
    {


        $all_ser = $request->all();


        if ($all_ser == null || $all_ser == '') {
            return response()->json('emp', 200);
            exit();
        }

        if (isset($all_ser['ser_id'])) {
            for ($i = 0; $i < count($all_ser['ser_id']); $i++) {

                $check_exists = employee_payroll::where('employee_id', $request->employee_paroll_id)
                    ->where('service_id', $all_ser['ser_id'][$i])
                    ->first();


                if (!$check_exists) {
                    $new_em_payroll = new employee_payroll();
                    $new_em_payroll->employee_id = $request->employee_paroll_id;
                    $new_em_payroll->service_id = $all_ser['ser_id'][$i];
                    $new_em_payroll->hourly_rate = $request->hourly_rate;
                    $new_em_payroll->milage_rate = $request->milage_rate;
                    $new_em_payroll->save();
                }
            }
        }


        return response()->json('done', 200);


        //        $new_em_payroll = new employee_payroll();
        //        $new_em_payroll->employee_id = $request->employee_paroll_id;
        //        $new_em_payroll->service_id = $request->service_id;
        //        $new_em_payroll->hourly_rate = $request->hourly_rate;
        //        $new_em_payroll->milage_rate = $request->milage_rate;
        //        $new_em_payroll->apply_all_activity = $request->apply_all_activity;
        //        $new_em_payroll->save();


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Payroll Created",
            'message' => " Staff Payroll Created",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Payroll Successfully Created');
    }

    public function employee_payroll_edit(Request $request)
    {


        $data = employee_payroll::where('id', $request->edit_id)->first();
        $data->employee_id = $request->employee_id;
        $data->service_id = $request->service_id;
        $data->hourly_rate = $request->hourly;
        $data->milage_rate = $request->milage;
        $data->apply_all_activity = $request->apply_all;
        $data->save();

        return back()->with('success', 'Employee Payroll Updated Successfully!');
    }


    public function employee_payroll_edit_bulk(Request $request)
    {

        $ids = explode(',', $request->edit_ids);

        $datas = employee_payroll::whereIn('id', $ids)->get();

        foreach ($datas as $data) {
            $val = employee_payroll::where('id', $data->id)->first();

            if ($request->check == 1) {
                $val->hourly_rate = $request->hourly_bulk;
                $val->milage_rate = $request->mileage_bulk;
            } else if ($request->check == 2) {
                $val->hourly_rate = $request->hourly_bulk;
            } else if ($request->check == 3) {
                $val->milage_rate = $request->mileage_bulk;
            }

            $val->save();
        }

        return back()->with('success', 'Employee Payroll Updated Successfully!');
    }


    public function employee_payroll_delete($id)
    {

        $data = employee_payroll::where('id', $id)->delete();

        return back()->with('success', 'Employee Payroll Deleted Successfully!');
    }

    public function employee_other_setup($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();

        $treatment_fac = Treatment_facility::where('admin_id', $this->admin_id)->get();
        foreach ($treatment_fac as $tre_fac) {
            $check_tx = Employee_details_tx_type::where('admin_id', $this->admin_id)
                ->where('employee_id', $id)
                ->where('treatment_id', $tre_fac->treatment_id)
                ->first();
            if (!$check_tx) {
                $new_data = new Employee_details_tx_type();
                $new_data->admin_id = $this->admin_id;
                $new_data->employee_id = $id;
                $new_data->treatment_id = $tre_fac->treatment_id;
                $new_data->treatment_name = $tre_fac->treatment_name;
                $new_data->box_24j = "";
                $new_data->id_qualifire = "";
                $new_data->save();
            }
        }

        $get_all_tx_types = Employee_details_tx_type::where('employee_id', $id)->get();

        $exists_setup = Employee_other_setup::where('employee_id', $id)->first();
        if ($exists_setup) {
            $em_setup = $exists_setup;
        } else {
            $em_setup = new employee_other_setup();
            $em_setup->employee_id = $id;
            $em_setup->save();
        }
        return view('superadmin.employee.employeeOtherSetup', compact('employee', 'em_setup', 'get_all_tx_types'));
    }

    public function employee_other_setup_update(Request $request)
    {
        $employee_other_setup_update = employee_other_setup::where('employee_id', $request->em_other_setup_up)->first();
        $employee_other_setup_update->max_hour_per_day = $request->max_hour_per_day;
        $employee_other_setup_update->max_hour_per_week = $request->max_hour_per_week;
        $employee_other_setup_update->adp_employee_id = $request->adp_employee_id;
        $employee_other_setup_update->provider_level = $request->provider_level;
        $employee_other_setup_update->custom_two = $request->custom_two;
        $employee_other_setup_update->custom_three = $request->custom_three;
        $employee_other_setup_update->custom_four = $request->custom_four;
        $employee_other_setup_update->custom_five = $request->custom_five;
        $employee_other_setup_update->custom_six = $request->custom_six;
        $employee_other_setup_update->heigh_degree = $request->heigh_degree;
        $employee_other_setup_update->degree_level = $request->degree_level;
        $employee_other_setup_update->external_software_id = $request->external_software_id;
        $employee_other_setup_update->signature_valid_form = $request->signature_valid_form;
        $employee_other_setup_update->signature_valid_to = $request->signature_valid_to;
        $employee_other_setup_update->paid_time_off = $request->paid_time_off;
        $employee_other_setup_update->exemt_staff = $request->exemt_staff;
        $employee_other_setup_update->gets_paid_holiday = $request->gets_paid_holiday;
        $employee_other_setup_update->is_parttime = $request->is_parttime;
        $employee_other_setup_update->is_contractor = $request->is_contractor;
        $employee_other_setup_update->provider_render_without = $request->provider_render_without;
        $employee_other_setup_update->save();


        $data = $request->all();

        if ($data) {
            for ($i = 0; $i < count($data['edit_tx_id']); $i++) {
                $update_tx = Employee_details_tx_type::where('employee_id', $request->em_other_setup_up)->where('id', $data['edit_tx_id'][$i])->first();
                if ($update_tx) {
                    $update_tx->box_24j = $data['box_24j'][$i];
                    $update_tx->id_qualifire = $data['id_qualifire'][$i];
                    $update_tx->save();
                }
            }
        }


        Client_activity::create([
            'admin_id' => Auth::user()->id,
            'title' => "Staff Other Setup Updated",
            'message' => " Staff Other Setup Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Employee Other Setup Successfully Updated');
    }


    public function employee_leave_tracking($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $employee_leave = Employee_leave::where('employee_id', $id)->paginate(20);
        return view('superadmin.employee.employeeLeaveTracking', compact('employee', 'employee_leave'));
    }

    public function employee_leave_save(Request $request)
    {
        $new_leave = new Employee_leave();
        $new_leave->admin_id = $this->admin_id;
        $new_leave->employee_id = $request->staff_id;
        $new_leave->leave_date = $request->leave_date;
        $new_leave->description = $request->description;
        $new_leave->save();
        return back()->with('success', 'Leave Successfully Created');
    }

    public function employee_leave_delete($id)
    {
        $staff_leave = Employee_leave::where('id', $id)->first();
        $staff_leave->delete();
        return back()->with('success', 'Leave Deleted Successfully');
    }


    public function employee_payor_exclusion($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $em_payor_exlus = Employee_payor_exclusion::where('employee_id', $id)->paginate(5);
        $em_payor_exlus_count = Employee_payor_exclusion::where('employee_id', $id)->count();
        return view('superadmin.employee.employeePayorExclusion', compact('employee', 'em_payor_exlus', 'em_payor_exlus_count'));
    }


    public function employee_payor_exclusion_save(Request $request)
    {
        $payor_id = $request->payor_id;

        for ($i = 0; $i < count($payor_id); $i++) {
            $new_payor_ex = new Employee_payor_exclusion();
            $new_payor_ex->employee_id = $request->exployee_payor_id;
            $new_payor_ex->payor_id = $payor_id[$i];
            $new_payor_ex->save();
        }


        return back()->with('success', 'Employee Payor Exclusion Successfully Created');
    }


    public function employee_show_all_payor(Request $request)
    {
        $assign_pyaor = Employee_exclude_payor::where('employee_id', $request->employee_id_get)->get();

        $array = [];
        foreach ($assign_pyaor as $asp) {
            array_push($array, $asp->payor_id);
        }

        $all_payor = All_payor::select('id', 'payor_name')->whereNotIn('id', $array)->orderBy('payor_name', 'asc')->get();
        return response()->json($all_payor, 200);
    }


    public function employee_show_add_payor(Request $request)
    {
        $all_payor = $request->payor_id;

        for ($i = 0; $i < count($all_payor); $i++) {
            $new_assign_payor = new Employee_exclude_payor();
            $new_assign_payor->admin_id = $this->admin_id;
            $new_assign_payor->employee_id = $request->employee_id;
            $new_assign_payor->payor_id = $all_payor[$i];
            $new_assign_payor->save();
        }

        return response()->json('done', 200);
    }


    public function employee_show_show_assign_payor(Request $request)
    {
        $assign_pyaor = Employee_exclude_payor::where('employee_id', $request->employee_id)->get();

        return response()->json([
            'notices' => $assign_pyaor,
            'view' => View::make('superadmin.employee.include.employeePayorExcludeInc', compact('assign_pyaor'))->render(),
        ]);
    }


    public function employee_delete_assign_payor(Request $request)
    {
        $del_payor = Employee_exclude_payor::where('id', $request->del_id)->where('employee_id', $request->employee_id)->first();

        if ($del_payor) {
            $del_payor->delete();
        }

        return response()->json('done', 200);
    }


    public function employee_subactivity_exclusion($id)
    {
        $employee = Employee::where('id', $id)->where('admin_id', $this->admin_id)->first();
        $em_ac_exlus = Employee_subactivity_exclusion::where('employee_id', $id)->paginate(5);
        $em_ac_exlus_count = Employee_subactivity_exclusion::where('employee_id', $id)->count();
        return view('superadmin.employee.employeeSubActivityExclusion', compact('employee', 'em_ac_exlus', 'em_ac_exlus_count'));
    }


    public function employee_subactivity_get_all(Request $request)
    {
        $employee = Employee::where('id', $request->employee_id)->first();

        $empp_sub_acts = Employee_subactivity_exclusion::where('employee_id', $request->employee_id)->get();
        $array = [];
        foreach ($empp_sub_acts as $emacts) {
            array_push($array, $emacts->sub_activity_id);
        }

        $sub_act = all_sub_activity::whereNotIn('id', $array)->where('admin_id', $employee->admin_id)->get();


        return response()->json($sub_act, 200);
    }

    public function employee_subactivity_exclusion_save(Request $request)
    {
        $activity_id = $request->sub_activity_id;

        for ($i = 0; $i < count($activity_id); $i++) {
            $new_payor_ex = new Employee_subactivity_exclusion();
            $new_payor_ex->admin_id = $this->admin_id;
            $new_payor_ex->employee_id = $request->employee_id;
            $new_payor_ex->sub_activity_id = $activity_id[$i];
            $new_payor_ex->save();
        }


        return response()->json('done', 200);
    }


    public function employee_get_assign_subactivity(Request $request)
    {
        $assign_sub_type = Employee_subactivity_exclusion::where('employee_id', $request->employee_id)->get();
        return response()->json([
            'notices' => $assign_sub_type,
            'view' => View::make('superadmin.employee.include.employeeSubActExcludeInc', compact('assign_sub_type'))->render(),
        ]);
    }


    public function employee_subactivity_exclusion_delete(Request $request)
    {
        $delete_sub_act = Employee_subactivity_exclusion::where('id', $request->del_id)->where('employee_id', $request->employee_id)->first();
        $delete_sub_act->delete();
        return response()->json('done', 200);
    }


    public function employee_hr_notes($id)
    {
        $employee = employee::where('id', $id)->where('admin_id', $this->admin_id)->first();


        $em_hr_notes = Employee_hr_note::where('employee_id', $id)->paginate(5);
        $em_hr_notes_count = employee_hr_note::where('employee_id', $id)->count();
        return view('superadmin.employee.employeeHrNotes', compact('employee', 'em_hr_notes', 'em_hr_notes_count'));
    }

    public function employee_hr_notes_save(Request $request)
    {
        $em_hr_note_save = new employee_hr_note();
        $em_hr_note_save->employee_id = $request->exployee_note_id;
        $em_hr_note_save->note_type = $request->note_type;
        $em_hr_note_save->note_details = $request->note_details;
        $em_hr_note_save->note_additional_details = $request->note_additional_details;
        $em_hr_note_save->save();
        return back()->with('success', 'Employee Hr Notes Successfully Created');
    }


    public function employee_client_exclusion($id)
    {
        $employee = employee::where('id', $id)->where('admin_id', $this->admin_id)->first();


        $clients = Client::orderBy('client_full_name', 'asc')->get();
        $em_clexs = Employee_client_exclusion::where('employee_id', $id)->paginate(5);
        $em_clexs_count = Employee_client_exclusion::where('employee_id', $id)->count();
        return view('superadmin.employee.employeeClientExclusion', compact('employee', 'em_clexs', 'em_clexs_count', 'clients'));
    }

    public function employee_client_exclusion_save(Request $request)
    {
        $client_id = $request->all_clints;

        for ($i = 0; $i < count($client_id); $i++) {
            $new_payor_ex = new Employee_client_exclusion();
            $new_payor_ex->admin_id = $this->admin_id;
            $new_payor_ex->employee_id = $request->employee_id;
            $new_payor_ex->client_id = $client_id[$i];
            $new_payor_ex->save();
        }


        return response()->json('done', 200);
    }


    public function employee_client_all_get(Request $request)
    {
        $employee = Employee::where('id', $request->employee_id)->first();

        $ass_clients = Employee_client_exclusion::where('employee_id', $request->employee_id)->get();
        $array = [];
        foreach ($ass_clients as $assclient) {
            array_push($array, $assclient->client_id);
        }


        $clients = Client::whereNotIn('id', $array)->where('admin_id', $employee->admin_id)->orderBy('client_full_name', 'asc')->get();
        return response()->json($clients, 200);
    }


    public function employee_get_assign_clients(Request $request)
    {
        $assign_clients = Employee_client_exclusion::where('employee_id', $request->employee_id)->get();
        return response()->json([
            'notices' => $assign_clients,
            'view' => View::make('superadmin.employee.include.employeeClientExcludeInc', compact('assign_clients'))->render(),
        ]);
    }


    public function employee_delete_assign_clients(Request $request)
    {
        $del_assign_client = Employee_client_exclusion::where('id', $request->del_id)->where('employee_id', $request->employee_id)->first();
        $del_assign_client->delete();
        return response()->json('done', 200);
    }


    public function employee_portal($id)
    {
        $employee = Employee::where('id', $id)->first();
        $check_features = employee_portal_feature::where('employee_id', $id)->first();
        if (!$check_features) {
            $new_fet = new employee_portal_feature();
            $new_fet->admin_id = $this->admin_id;
            $new_fet->employee_id = $id;
            $new_fet->save();
        } else {
            $new_fet = $check_features;
        }
        return view('superadmin.employee.employeePortal', compact('employee', 'new_fet'));
    }


    public function employee_portal_features_save(Request $request)
    {
        $features = employee_portal_feature::where('employee_id', $request->fet_em_id)->first();
        $features->is_secure = $request->is_secure;
        $features->access_billing = $request->access_billing;
        $features->pay_balance = $request->pay_balance;
        $features->save();
        return back()->with('success', 'Portal Features Successfully Updated');
    }


    public function employee_portal_send_access(Request $request)
    {

        $email = $request->access_email;

        $provider_id = $request->employee_id;

        if (portal_access_email::where('admin_id', $this->admin_id)->where('provider_id', $provider_id)->where('is_use', 1)->count() > 0) {
            return back()->with('alert', 'Already signed in!');
        }
        $provider = Employee::where('admin_id', $this->admin_id)->where('id', $provider_id)->where('office_email', $email)->first();

        if ($provider) {
            $new_access = new portal_access_email();
            $new_access->admin_id = $this->admin_id;
            $new_access->provider_id = $provider->id;
            $new_access->email = $email;
            $new_access->verify_id = rand(00000, 99999) . $provider_id . rand(00, 99) . rand(00000, 999999);
            $new_access->is_use = 0;
            $new_access->save();


            $to = $email;
            $url = route('access.email.add.password', $new_access->verify_id);
            $msg = [
                'name' => $provider->full_name,
                'url' => $url
            ];
            Mail::to($to)->send(new ProviderAccessEmail($msg));
            return back()->with('success', 'Portal Link Has Been Send');
        } else {
            return back()->with('alert', 'Staff Not Found');
        }
    }


    public function employee_reset_link(Request $request)
    {
        $date = $request->ex_date;
        $e_id = $request->e_id;
        $token = Carbon::parse($date)->timestamp . 'o' . $e_id . 'o' . rand(00, 99) . rand(00000, 999999);
        $url = route('reset.password.link', $token);
        reset_password_link::where('target_id', $e_id)->where('target_type', 'staff')->delete();
        $data = new reset_password_link();
        $data->send_by = Auth::user()->id;
        $data->target_id = $e_id;
        $data->target_type = "staff";
        $data->url = $url;
        $data->expiry_date = $date;
        $data->save();
        return $url;
    }

    public function staff_send_reset_password(Request $request)
    {
        $provider = Employee::where('admin_id', $this->admin_id)->where('id', $request->e_id)->where('office_email', $request->email)->first();
        if ($provider) {
            $msg = [
                'name' => $provider->full_name,
                'url' => $request->url
            ];
            Mail::to($request->email)->send(new StaffResetPassword($msg));
        }
        return "success";
    }

    public function employee_vacation_approval($id, $status)
    {
        $data = Employee_leave::where('id', $id)->first();
        $data->status = $status;
        $data->save();
        return back()->with('success', 'Leave ' . $status . '.');
    }

    public function employee_schedule($id)
    {
        $emp = Employee::where('id', $id)->first();
        $all_patients = Client::select('id', 'admin_id', 'client_full_name')->where('admin_id', $this->admin_id)->get();
        $poin_service = point_of_service::where('admin_id', $this->admin_id)->get();
        return view('superadmin.employee.calenderSchedule', compact('emp', 'all_patients', 'poin_service'));
    }

    public function employee_schedule_data_get(Request $request)
    {


        $get_start = $request->start;
        $get_end = $request->end;
        $staff_id = $request->staff_id;


        $mil = $get_start;
        $seconds = ceil($mil / 1000);

        $mil2 = $get_end;
        $seconds2 = ceil($mil2 / 1000);

        $data1 = date('Y-m-d', $seconds);
        $data2 = date('Y-m-d', $seconds2);

        $events = \App\Models\Appoinment::where('admin_id', $this->admin_id)
            ->where('provider_id', $staff_id)
            ->where('schedule_date', '>=', $data1)
            ->where('schedule_date', '<=', $data2)
            ->get();

        //        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {


            //$client = Client::where('id',$event->client_id)->first();
            $pro_data = Employee::select('last_name', 'first_name', 'back_color', 'text_color')->where('id', $event->provider_id)->first();
            $client = Client::where('admin_id', $this->admin_id)->where('id', $event->client_id)->first();

            if ($client) {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name . substr($client->client_last_name, 0, 2) . ' ' . substr($client->client_first_name, 0, 2);
            } else {
                if ($pro_data) {
                    $pro_name = substr($pro_data->last_name, 0, 2) . ' ' . substr($pro_data->first_name, 0, 2) . ' : ';
                } else {
                    $pro_name = '';
                }
                $client_name = $pro_name;
            }


            //            $event['start_time'] = date('g:iA', strtotime($event['from_time']));
            $event['start_time'] = date('g:iA', strtotime($event['start_time']));
            $event['end_time'] = date('g:iA', strtotime($event['to_time']));
            $event['title'] = $client_name;
            if ($event->location == '02' || $event->location == '10') {
                $event['icon'] = 'camera';
            } else {
                $event['icon'] = "none";
            }

            if ($pro_data) {
                if ($pro_data->back_color != null) {
                    $event['textColor'] = "#000";
                    $event['backgroundColor'] = $pro_data->back_color;
                    $event['display'] = "block";
                } else {
                    $event['textColor'] = "#000000";
                    $event['backgroundColor'] = "#E0EBF5";
                    $event['display'] = "block";
                }
            } else {
                $event['textColor'] = "#000000";
                $event['backgroundColor'] = "#E0EBF5";
                $event['display'] = "block";
                $event['date'] = $event;
            }


            if (!(int)$event['is_all_day']) {
                $event['allDay'] = false;
                $event['start'] = Carbon::createFromTimestamp(strtotime($event['from_time']))->toIso8601String();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['to_time']))->toIso8601String();
            } else {
                $event['allDay'] = true;
                $event['start'] = $event['from_time'] . "T" . "12:00:00";
                $event['end'] = $event['to_time'] . "T" . "23:59:00";
            }
            if (isset($event['from_time']) && !empty($event['to_time'])) {
                $event['cstm_deadline'] = $_date = date('Y-m-d', strtotime($event['to_time']));
            }


            $event['eventid'] = $event['id'];
            array_push($data, $event);
        }


        return response()->json($data);
    }
}
