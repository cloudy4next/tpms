<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\all_sub_activity;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Employee_clearance;
use App\Models\Employee_client_exclusion;
use App\Models\Employee_contact_detail;
use App\Models\Employee_credential;
use App\Models\Employee_department;
use App\Models\Employee_emergency_contact_detail;
use App\Models\Employee_exclude_payor;
use App\Models\Employee_hr_note;
use App\Models\Employee_leave;
use App\Models\Employee_other_setup;
use App\Models\Employee_payor_exclusion;
use App\Models\Employee_payroll;
use App\Models\Employee_qualification;
use App\Models\Employee_subactivity_exclusion;
use App\Models\Employee_type_assign;
use App\Models\Treatment_facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class ProviderInfoController extends Controller
{
    public function provider_info()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $assign_type = Employee_type_assign::where('admin_id', Auth::user()->admin_id)->get();
        $tx_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.info.providerInfo', compact('employee', 'assign_type', 'tx_types'));
    }


    public function provider_info_update(Request $request)
    {

        $employe_bio_update = Employee::where('id', Auth::user()->id)->first();
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $ext = $request->file('profile_photo')->extension();
            $imageName = time() . uniqid() . '.' . $ext;
            $directory = 'assets/profile/';
            $imgUrl = $directory . $imageName;
            Image::make($image)->save($imgUrl);
            $employe_bio_update->profile_photo = $imgUrl;
        }
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
        $employe_bio_update->timezone = $request->default_tz;
        $employe_bio_update->save();

        return back()->with('success', 'Biographic Successfully Updated');
    }


    public function provider_contact_info()
    {

        $employee_name = Employee::where('id', Auth::user()->id)->first();
        $exist_employee = Employee_contact_detail::where('employee_id', Auth::user()->id)->first();
        $exist_employee_em = Employee_emergency_contact_detail::where('employee_id', Auth::user()->id)->first();

        if ($exist_employee) {
            $employee = $exist_employee;
        } else {
            $employee = new employee_contact_detail();
            $employee->employee_id = Auth::user()->id;
            $employee->save();
        }


        if ($exist_employee_em) {
            $employee_em = $exist_employee_em;
        } else {
            $employee_em = new Employee_emergency_contact_detail();
            $employee_em->employee_id = Auth::user()->id;
            $employee_em->save();
        }

        return view('provider.info.providerContactDetails', compact('employee', 'employee_em', 'employee_name'));
    }

    public function provider_contact_details_update(Request $request)
    {
        $employe_contact_update = employee_contact_detail::where('employee_id', Auth::user()->id)->first();
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

        return back()->with('success', 'Contact Details Successfully Updated');
    }


    public function provider_emergency_contact_update(Request $request)
    {
        $employe_em_contact_update = employee_emergency_contact_detail::where('employee_id', Auth::user()->id)->first();
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


        return back()->with('success', 'Emergency Contact Details Successfully Updated');
    }


    public function credentials()
    {

        $employee = Employee::where('id', Auth::user()->id)->first();
        $cred_lists = Employee_credential::where('employee_id', Auth::user()->id)->paginate(10);
        $clen_lists = Employee_clearance::where('employee_id', Auth::user()->id)->paginate(10);
        $qua_lists = Employee_qualification::where('employee_id', Auth::user()->id)->paginate(10);
        return view('provider.info.providerCredentials', compact('employee', 'cred_lists', 'clen_lists', 'qua_lists'));
    }

    public function credentials_save(Request $request)
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

        // Client_activity::create([
        //     'admin_id' => Auth::user()->admin_id,
        //     'title' => "Staff Credential Created",
        //     'message' => " Staff Credential Created",
        //     'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        // ]);


        return back()->with('success', 'Credentials Successfully Created');
    }

    public function credentials_update(Request $request)
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

        return back()->with('success', 'Credentials Updated Successfully!');
    }

    public function credentials_delete(Request $request)
    {
        $data = employee_credential::where('id', $request->id)->delete();

        return back()->with('success', 'Credentials Deleted Successfully!');
    }

    public function clearance_save(Request $request)
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


        // Client_activity::create([
        //     'admin_id' => Auth::user()->admin_id,
        //     'title' => "Staff Clearance Created",
        //     'message' => " Staff Clearance Created",
        //     'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        // ]);

        return back()->with('success', 'Clearance Successfully Created');
    }

    public function clearance_update(Request $request)
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
        return back()->with('success', 'Clearance Updated Successfully!');
    }

    public function clearance_delete(Request $request)
    {
        $data = employee_clearance::where('id', $request->id)->delete();
        return back()->with('success', 'Clearance Deleted Successfully!');
    }


    public function qualification_save(Request $request)
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


        // Client_activity::create([
        //     'admin_id' => Auth::user()->id,
        //     'title' => "Staff Qualification Created",
        //     'message' => " Staff Qualification Created",
        //     'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        // ]);

        return back()->with('success', 'Qualification Successfully Created');
    }

    public function qualification_update(Request $request)
    {
        $data = employee_qualification::where('id', $request->qual_id)->first();
        $data->qualification_name = $request->qual_type;
        $data->qualification_date_issue = $request->date_issue;
        $data->qualification_date_exp = $request->date_expire;
        $data->qualification_applicable = $request->qual_apply;
        $data->save();
        return back()->with('success', 'Qualification Updated Successfully!');
    }

    public function qualification_delete(Request $request)
    {
        $data = employee_qualification::where('id', $request->id)->delete();
        return back()->with('success', 'Qualification Deleted Successfully!');
    }


    public function department()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $exist_dep_a = Employee_department::where('employee_id', Auth::user()->id)->first();
        if ($exist_dep_a) {
            $exist_dep = $exist_dep_a;
        } else {
            $exist_dep = new employee_department();
            $exist_dep->admin_id = Auth::user()->admin_id;
            $exist_dep->employee_id = Auth::user()->id;
            $exist_dep->save();
        }

        $clients = Employee::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.info.providerDepartment', compact('exist_dep', 'clients', 'employee'));
    }


    public function department_save(Request $request)
    {
        $update_emp_dep = Employee_department::where('employee_id', Auth::user()->id)->first();
        $update_emp_dep->admin_id = Auth::user()->admin_id;
        $update_emp_dep->is_supervisor = $request->is_supervisor;
        $update_emp_dep->supervisor_id = $request->supervisor_id;
        $update_emp_dep->save();


        return back()->with('success', 'Department Successfully Created');
    }


    public function payroll()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $em_payrols = Employee_payroll::where('employee_id', Auth::user()->id)->paginate(5);
        $all_sub_act = all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.info.providerPayroll', compact('employee', 'em_payrols', 'all_sub_act'));
    }


    public function payroll_save(Request $request)
    {
        $new_em_payroll = new Employee_payroll();
        $new_em_payroll->employee_id = Auth::user()->id;
        $new_em_payroll->activity = $request->activity;
        $new_em_payroll->hourly_rate = $request->hourly_rate;
        $new_em_payroll->milage_rate = $request->milage_rate;
        $new_em_payroll->apply_all_activity = $request->apply_all_activity;
        $new_em_payroll->save();


        return back()->with('success', 'Payroll Successfully Created');
    }


    public function other_setup()
    {

        $employee = Employee::where('id', Auth::user()->id)->first();
        $exists_setup = Employee_other_setup::where('employee_id', Auth::user()->id)->first();
        if ($exists_setup) {
            $em_setup = $exists_setup;
        } else {
            $em_setup = new Employee_other_setup();
            $em_setup->employee_id = Auth::user()->id;
            $em_setup->save();
        }

        return view('provider.info.providerOtherSetup', compact('employee', 'em_setup'));
    }


    public function other_setup_update(Request $request)
    {
        $employee_other_setup_update = employee_other_setup::where('employee_id', Auth::user()->id)->first();
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


        return back()->with('success', 'Other Setup Successfully Updated');
    }


    public function leave_tracking()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $employee_leave = Employee_leave::where('employee_id', Auth::user()->id)->paginate(20);
        return view('provider.info.providerLeaveTracking', compact('employee', 'employee_leave'));
    }


    public function leave_tracking_save(Request $request)
    {
        $new_leave = new Employee_leave();
        $new_leave->admin_id = Auth::user()->admin_id;
        $new_leave->employee_id = Auth::user()->id;
        $new_leave->leave_date = $request->leave_date;
        $new_leave->description = $request->description;
        $new_leave->save();
        return back()->with('success', 'Leave Successfully Created');
    }


    public function insurance_exclusion()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $em_payor_exlus = Employee_payor_exclusion::where('employee_id', Auth::user()->id)->paginate(5);
        $em_payor_exlus_count = Employee_payor_exclusion::where('employee_id', Auth::user()->id)->count();
        return view('provider.info.providerPayorExclution', compact('employee', 'em_payor_exlus', 'em_payor_exlus_count'));
    }

    public function insurance_exclusion_save(Request $request)
    {
        $payor_id = $request->payor_id;

        for ($i = 0; $i < count($payor_id); $i++) {
            $new_payor_ex = new Employee_payor_exclusion();
            $new_payor_ex->employee_id = Auth::user()->id;
            $new_payor_ex->payor_id = $payor_id[$i];
            $new_payor_ex->save();
        }


        return back()->with('success', 'Payor Exclusion Successfully Created');
    }


    public function insurance_exclusion_show_all_payor(Request $request)
    {
        $assign_pyaor = Employee_exclude_payor::where('employee_id', Auth::user()->id)->get();

        $array = [];
        foreach ($assign_pyaor as $asp) {
            array_push($array, $asp->payor_id);
        }

        $all_payor = All_payor::select('id', 'payor_name')->whereNotIn('id', $array)->get();
        return response()->json($all_payor, 200);
    }


    public function insurance_exclusion_show_assign_payor(Request $request)
    {
        $assign_pyaor = Employee_exclude_payor::where('employee_id', Auth::user()->id)->get();

        return response()->json([
            'notices' => $assign_pyaor,
            'view' => View::make('provider.info.include.employeePayorExcludeInc', compact('assign_pyaor'))->render(),
        ]);
    }


    public function insurance_exclusion_add_payor(Request $request)
    {
        $all_payor = $request->payor_id;

        for ($i = 0; $i < count($all_payor); $i++) {
            $new_assign_payor = new Employee_exclude_payor();
            $new_assign_payor->admin_id = Auth::user()->admin_id;
            $new_assign_payor->employee_id = Auth::user()->id;
            $new_assign_payor->payor_id = $all_payor[$i];
            $new_assign_payor->save();
        }

        return response()->json('done', 200);
    }


    public function insurance_exclusion_delete_payor(Request $request)
    {
        $del_payor = Employee_exclude_payor::where('id', $request->del_id)->where('employee_id', Auth::user()->id)->first();

        if ($del_payor) {
            $del_payor->delete();
        }

        return response()->json('done', 200);
    }


    public function subactivity_exclusion()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $em_ac_exlus = Employee_subactivity_exclusion::where('employee_id', Auth::user()->id)->paginate(5);
        $em_ac_exlus_count = Employee_subactivity_exclusion::where('employee_id', Auth::user()->id)->count();
        return view('provider.info.providerSubactivityExclusion', compact('employee', 'em_ac_exlus', 'em_ac_exlus_count'));
    }


    public function subactivity_exclusion_save(Request $request)
    {
        $activity_id = $request->sub_activity_id;

        for ($i = 0; $i < count($activity_id); $i++) {
            $new_payor_ex = new Employee_subactivity_exclusion();
            $new_payor_ex->admin_id = Auth::user()->admin_id;
            $new_payor_ex->employee_id = Auth::user()->id;
            $new_payor_ex->sub_activity_id = $activity_id[$i];
            $new_payor_ex->save();
        }


        return response()->json('done', 200);
    }


    public function subactivity_exclusion_get_all_sub_act(Request $request)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();

        $empp_sub_acts = Employee_subactivity_exclusion::where('employee_id', Auth::user()->id)->get();
        $array = [];
        foreach ($empp_sub_acts as $emacts) {
            array_push($array, $emacts->sub_activity_id);
        }

        $sub_act = all_sub_activity::whereNotIn('id', $array)->where('admin_id', $employee->admin_id)->get();

        return response()->json($sub_act, 200);
    }


    public function subactivity_exclusion_get_assign_sub_act(Request $request)
    {
        $assign_sub_type = Employee_subactivity_exclusion::where('employee_id', Auth::user()->id)->get();
        return response()->json([
            'notices' => $assign_sub_type,
            'view' => View::make('provider.info.include.employeeSubActExcludeInc', compact('assign_sub_type'))->render(),
        ]);
    }


    public function subactivity_exclusion_delete_sub_act(Request $request)
    {
        $delete_sub_act = Employee_subactivity_exclusion::where('id', $request->del_id)->where('employee_id', Auth::user()->id)->first();
        $delete_sub_act->delete();
        return response()->json('done', 200);
    }


    public function patient_exclustion()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $clients = Client::where('admin_id', Auth::user()->admin_id)->get();
        $em_clexs = Employee_client_exclusion::where('employee_id', Auth::user()->id)->paginate(5);
        $em_clexs_count = Employee_client_exclusion::where('employee_id', Auth::user()->id)->count();
        return view('provider.info.providerPatientExclusion', compact('employee', 'clients', 'em_clexs', 'em_clexs_count'));
    }


    public function patient_exclustion_save(Request $request)
    {
        $client_id = $request->all_clints;

        for ($i = 0; $i < count($client_id); $i++) {
            $new_payor_ex = new employee_client_exclusion();
            $new_payor_ex->admin_id = Auth::user()->admin_id;
            $new_payor_ex->employee_id = Auth::user()->id;
            $new_payor_ex->client_id = $client_id[$i];
            $new_payor_ex->save();
        }


        return response()->json('done', 200);
    }


    public function patient_exclustion_get_all_client(Request $request)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();

        $ass_clients = Employee_client_exclusion::where('employee_id', Auth::user()->id)->get();
        $array = [];
        foreach ($ass_clients as $assclient) {
            array_push($array, $assclient->client_id);
        }


        $clients = Client::whereNotIn('id', $array)->where('admin_id', $employee->admin_id)->get();
        return response()->json($clients, 200);
    }


    public function patient_exclustion_get_assign_client(Request $request)
    {
        $assign_clients = Employee_client_exclusion::where('employee_id', Auth::user()->id)->get();
        return response()->json([
            'notices' => $assign_clients,
            'view' => View::make('provider.info.include.employeeClientExcludeInc', compact('assign_clients'))->render(),
        ]);
    }


    public function patient_exclustion_delete_client(Request $request)
    {
        $del_assign_client = Employee_client_exclusion::where('id', $request->del_id)->where('employee_id', Auth::user()->id)->first();
        $del_assign_client->delete();
        return response()->json('done', 200);
    }

}
