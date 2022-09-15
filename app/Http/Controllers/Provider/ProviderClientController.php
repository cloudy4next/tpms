<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\All_payor;
use App\Models\all_sub_activity;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_activity;
use App\Models\Client_address;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\client_color;
use App\Models\Client_document;
use App\Models\Client_email;
use App\Models\Client_guarantar_info;
use App\Models\Client_info;
use App\Models\Client_phone;
use App\Models\Client_portal;
use App\Models\Employee_department;
use App\Models\Payor_facility;
use App\Models\rate_list;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use App\Models\Treatment_facility;
use App\Models\zone_setup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class ProviderClientController extends Controller
{

    public function patient_list()
    {
        return view('provider.client.clientList');
    }

    public function patient_list_get(Request $request)
    {
        $name = $request->name;
        $coatct = $request->contact;
        $dob = $request->dob;
        $gen = $request->gender;

        $admin_id = Auth::user()->admin_id;


        $apps = Appoinment::select('provider_id', 'admin_id', 'client_id')->where('provider_id', Auth::user()->id)->where('admin_id', $admin_id)->get();
        $array = [];
        foreach ($apps as $ap) {
            array_push($array, $ap->client_id);
        }


        $query = "SELECT * FROM clients WHERE admin_id=$admin_id ";

        $CLIENT_filter = implode("','", $array);
        $query .= "AND id IN('" . $CLIENT_filter . "')   ";

        if (empty($name) && empty($coatct) && empty($dob) && empty($gen)) {
            $query .= "ORDER BY client_full_name ASC";
            $query_exe = DB::select($query);
        }

        if (isset($name)) {
            $query .= "AND client_full_name LIKE '%$name%'";
            $query_exe = DB::select($query);
        }

        if (isset($coatct)) {
            $query .= "AND phone_number LIKE '%$coatct%'";
            $query_exe = DB::select($query);
        }

        if (isset($dob)) {
            $query .= "AND client_dob LIKE '%$dob%'";
            $query_exe = DB::select($query);
        }

        if (isset($gen)) {
            $query .= "AND client_gender='$gen'";
            $query_exe = DB::select($query);
        }


        $clients = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $clients,
            'view' => View::make('provider.client.include.clientListInclude', compact('clients'))->render(),
            'pagination' => (string)$clients->links(),
            'data_type' => 1
        ]);
    }


    public function patient_list_get_next(Request $request)
    {
        $name = $request->name;
        $coatct = $request->contact;
        $dob = $request->dob;
        $gen = $request->gender;

        $admin_id = Auth::user()->admin_id;


        $apps = Appoinment::select('provider_id', 'admin_id', 'client_id')->where('provider_id', Auth::user()->id)->where('admin_id', $admin_id)->get();
        $array = [];
        foreach ($apps as $ap) {
            array_push($array, $ap->client_id);
        }


        $query = "SELECT * FROM clients WHERE admin_id=$admin_id ";

        $CLIENT_filter = implode("','", $array);
        $query .= "AND id IN('" . $CLIENT_filter . "')   ";

        if (empty($name) && empty($coatct) && empty($dob) && empty($gen)) {
            $query .= "ORDER BY client_full_name ASC";
            $query_exe = DB::select($query);
        }

        if (isset($name)) {
            $query .= "AND client_full_name LIKE '%$name%'";
            $query_exe = DB::select($query);
        }

        if (isset($coatct)) {
            $query .= "AND phone_number LIKE '%$coatct%'";
            $query_exe = DB::select($query);
        }

        if (isset($dob)) {
            $query .= "AND client_dob LIKE '%$dob%'";
            $query_exe = DB::select($query);
        }

        if (isset($gen)) {
            $query .= "AND client_gender='$gen'";
            $query_exe = DB::select($query);
        }


        $clients = $this->arrayPaginator($query_exe, $request);

        return response()->json([
            'notices' => $clients,
            'view' => View::make('provider.client.include.clientListInclude', compact('clients'))->render(),
            'pagination' => (string)$clients->links(),
            'data_type' => 1
        ]);
    }


    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

    }


    public function patient_list_change_client_status(Request $request)
    {
        $client = Client::where('id', $request->client_id)->first();
        $client->is_active_client = $request->is_active;
        $client->save();
        return response()->json('done', 200);
    }


    public function patient_info($id)
    {
        $client_id = Client::where('id', $id)->first();
        $phones = Client_phone::where('client_id', $id)->get();
        $emails = Client_email::where('client_id', $id)->get();
        $address = Client_address::where('client_id', $id)->get();
        $all_zone = zone_setup::all();


        $exist_client_info = Client_info::where('client_id', $id)->first();
        if ($exist_client_info) {
            $client_info = $exist_client_info;
        } else {
            $client_info = new client_info();
            $client_info->client_id = $client_id->id;
            $client_info->save();
        }

        $client_garanter_info = Client_guarantar_info::where('client_id', $id)->first();
        if ($client_garanter_info) {
            $garanter_info = $client_garanter_info;
        } else {
            $garanter_info = new client_guarantar_info();
            $garanter_info->client_id = $id;
            $garanter_info->admin_id = Auth::user()->id;
            $garanter_info->save();
        }

        $client_color_check = client_color::where('provider_id', Auth::user()->id)->where('client_id', $id)->first();
        if ($client_color_check) {
            $client_color = $client_color_check;
        } else {
            $client_color = new client_color();
            $client_color->provider_id = Auth::user()->id;
            $client_color->client_id = $id;
            $client_color->back_color = '#080c26';
            $client_color->text_color = '#d8e4e4';
            $client_color->save();
        }


        $box_32 = setting_name_location_box_two::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.client.clientInfo', compact('client_id', 'client_info', 'phones', 'emails', 'address', 'garanter_info', 'all_zone', 'box_32', 'client_color'));
    }


    public function patient_update(Request $request)
    {
        $this->validate($request, [
            'client_first_name' => 'required',
            'client_last_name' => 'required',
            'client_dob' => 'required',
            'client_gender' => 'required',
            'relationship' => 'required|not_in:0',
            'client_street' => 'required',
            'client_city' => 'required',
            'client_state' => 'required|not_in:0',
            'client_zip' => 'required',
        ], [
            'client_first_name.required' => 'Please Enter Client First Name',
            'client_last_name.required' => 'Please Enter Client Last Name',
            'client_dob.required' => 'Please Enter Client DOB',
            'client_gender.required' => 'Please Select Client Gender',
            'relationship.not_in' => 'Please Select Client Relationship',
            'client_street.required' => 'Please Enter Street',
            'client_city.required' => 'Please Enter City',
            'client_state.not_in' => 'Please Select State',
            'client_zip.required' => 'Please Enter Zip',
        ]);


        $client = client::where('id', $request->client_edit_id)->where('admin_id', Auth::user()->admin_id)->first();
        $client->is_active_client = $request->is_active_client;
        $client->client_full_name = $request->client_first_name . ' ' . $request->client_middle . ' ' . $request->client_last_name;
        $client->client_first_name = $request->client_first_name;
        $client->client_middle = $request->client_middle;
        $client->client_last_name = $request->client_last_name;
        $client->client_preferred = $request->client_preferred;
        $client->phone_number = $request->client_phone;
        $client->phone_type = $request->client_phone_type;
        $client->is_voice_sms = $request->is_voice_sms;
        $client->is_send_sms = $request->is_send_sms;
        $client->email = $request->client_email;
        $client->email_type = $request->client_email_type;
        $client->email_reminder = $request->email_reminder;
        $client->is_email_ok = $request->is_email_ok;
        $client->client_dob = Carbon::parse($request->client_dob)->format('Y-m-d');
        $client->client_gender = $request->client_gender;
        $client->client_street = $request->client_street;
        $client->client_city = $request->client_city;
        $client->client_state = $request->client_state;
        $client->client_zip = $request->client_zip;
        $client->location = $request->location;
        $client->zone = $request->zone;
        $client->save();


        $client_info = client_info::where('client_id', $client->id)->where('admin_id', Auth::user()->admin_id)->first();

        if ($request->hasFile('signature_image')) {
            @unlink($client_info->signature_image);
            $image = $request->file('signature_image');
            $imageName = uniqid() . $client_info->id . time() . '.' . $image->getClientOriginalName('signature_image');
            $directory = 'assets/dashboard/images/signature/';
            $imgUrl = $directory . $imageName;
            Image::make($image)->save($imgUrl);
            $client_info->signature_image = $imgUrl;
        }

        $client_info->is_active_client = $request->is_active_client;
        $client_info->client_gender_identity = $request->client_gender_identity;
        $client_info->client_relationship = $request->client_relationship;
        $client_info->client_employe_status = $request->client_employe_status;
        $client_info->race_ethnicity = $request->race_ethnicity;
        $client_info->race_ethnicity_details = $request->race_ethnicity_details;
        $client_info->preferred_language = $request->preferred_language;
        $client_info->client_notes = $request->client_notes;
        $client_info->client_date_first_seen = $request->client_date_first_seen;
        $client_info->client_reffered_by = $request->client_reffered_by;
        $client_info->relationship = $request->relationship;
        $client_info->asignment = $request->asignment;
        $client_info->is_guarantor = $request->is_guarantor;
        $client_info->save();


        $client_garanter_info = client_guarantar_info::where('client_id', $client->id)->where('admin_id', Auth::user()->admin_id)->first();
        $client_garanter_info->guarantor_first_name = $request->guarantor_first_name;
        $client_garanter_info->guarantor_last_name = $request->guarantor_last_name;
        $client_garanter_info->guarantor_relationship = $request->guarantor_relationship;
        $client_garanter_info->guarantor_dob = Carbon::parse($request->guarantor_dob)->format('Y-m-d');
        $client_garanter_info->g_street = $request->g_street;
        $client_garanter_info->g_city = $request->g_city;
        $client_garanter_info->g_state = $request->g_state;
        $client_garanter_info->g_zip = $request->g_zip;
        $client_garanter_info->save();


        $data = $request->all();


        //phone create or update
        if (isset($data['new_phone_number'])) {
            for ($i = 0; $i < count($request->new_phone_number); $i++) {
                client_phone::updateOrCreate(['id' => $data['client_phone_edit'][$i],], [
                    'admin_id' => Auth::user()->admin_id,
                    'client_id' => $client->id,
                    'phone_number' => $data['new_phone_number'][$i],
                    'phone_type' => isset($data['new_phone_type'][$i]) ? $data['new_phone_type'][$i] : null,
                    'is_send_sms' => isset($request->new_is_send_sms[$i]) ? $request->new_is_send_sms[$i] : null,
                    'is_voice_sms' => isset($data['new_is_voice_sms'][$i]) ? $data['new_is_voice_sms'][$i] : null
                ]);
            }
        }

        //email create or update
        if (isset($data['new_email'])) {
            for ($i = 0; $i < count($data['new_email']); $i++) {
                client_email::updateOrCreate(['id' => $data['edit_email_id'][$i],], [
                    'admin_id' => Auth::user()->admin_id,
                    'client_id' => $client->id,
                    'email' => $request->new_email[$i],
                    'email_type' => isset($data['new_email_type'][$i]) ? $data['new_email_type'][$i] : null,
                    'email_reminder' => isset($data['new_email_reminder'][$i]) ? $data['new_email_reminder'][$i] : null,
                    'is_email_ok' => isset($data['new_is_email_ok'][$i]) ? $data['new_is_email_ok'][$i] : null,
                ]);

            }
        }


        //address create or update
        if (isset($data['address_edit_id'])) {
            for ($i = 0; $i < count($data['address_edit_id']); $i++) {
                client_address::updateOrCreate(['id' => $data['address_edit_id'][$i],], [
                    'admin_id' => Auth::user()->admin_id,
                    'client_id' => $client->id,
                    'street' => isset($data['street'][$i]) ? $data['street'][$i] : null,
                    'city' => isset($data['city'][$i]) ? $data['city'][$i] : null,
                    'state' => isset($data['state'][$i]) ? $data['state'][$i] : null,
                    'zip' => isset($data['zip'][$i]) ? $data['zip'][$i] : null,
                    'location' => isset($data['location'][$i]) ? $data['location'][$i] : null,
                ]);

            }

        }


        $check_color = client_color::where('provider_id', Auth::user()->id)->where('client_id', $client->id)->first();
        if ($check_color) {
            $check_color->back_color = $request->back_color;
            $check_color->text_color = $request->text_color;
            $check_color->save();
        } else {
            $new_color = new client_color();
            $new_color->provider_id = Auth::user()->id;
            $new_color->client_id = $client->id;
            $new_color->back_color = $request->back_color;
            $new_color->text_color = $request->text_color;
            $new_color->save();
        }


        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $client->id,
            'title' => "Client Info Updated",
            'message' => "Client Info Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);


        return back()->with('success', 'Patient Info Updated Successfully');
    }


    public function patient_sing_delete(Request $request)
    {
        $delete_sign = Client_info::where('client_id', $request->client_id)->first();
        if (!empty($delete_sign->signature_image) && file_exists($delete_sign->signature_image)) {
            unlink($delete_sign->signature_image);
            return response()->json('done', 200);
        } else {
            return response()->json('not done', 200);
        }
    }


    public function patient_exists_client_phon_delete(Request $request)
    {
        $delete_phone = client_phone::where('id', $request->phonid)->first();
        $delete_phone->delete();
    }


    public function patient_exists_client_email_delete(Request $request)
    {
        $delete_email = client_email::where('id', $request->emailid)->first();
        $delete_email->delete();
    }


    public function patient_exists_client_address_delete(Request $request)
    {
        $delete_address = client_address::where('id', $request->addressid)->first();
        $delete_address->delete();
    }


    public function patient_authorization($id)
    {
        $client_id = Client::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $all_authorizations = Client_authorization::where('client_id', $id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(15);
        $cpt_cores = setting_cpt_code::where('admin_id', Auth::user()->admin_id)->get();
        $all_sub_acts = all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.client.clientAuthorizationList', compact('client_id', 'all_authorizations', 'cpt_cores', 'all_sub_acts'));
    }


    public function patient_authorization_create($id)
    {
        $client_data_exitst = Client::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $client_info_data_exitst = Client_info::where('client_id', $id)->where('admin_id', Auth::user()->admin_id)->first();

        if ($client_data_exitst->client_first_name == null || $client_data_exitst->client_last_name == null || $client_data_exitst->client_dob == null || $client_data_exitst->client_gender == null || $client_data_exitst->email == null || $client_data_exitst->phone_number == null || $client_data_exitst->location == null || $client_data_exitst->zone == null || $client_data_exitst->client_street == null ||
            $client_data_exitst->client_city == null || $client_data_exitst->client_state == null || $client_data_exitst->client_zip == null) {
            return back()->with('alert', 'Complete the client info to create authorization');
            exit();
        }

        if ($client_info_data_exitst->relationship == null) {
            return back()->with('alert', 'Complete the client info to create authorization');
            exit();
        }

        $client_id = Client::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $all_payors = Payor_facility::where('admin_id', Auth::user()->admin_id)->get();
        $supervisor = Employee_department::where('is_supervisor', 1)->where('admin_id', Auth::user()->admin_id)->get();
        $treatment_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.client.clientAuthorizationCreate', compact('client_id', 'all_payors', 'supervisor', 'treatment_types'));
    }


    public function patient_authorization_save(Request $request)
    {
        $date = $request->select_date;
        $first_date = substr($request->select_date, 0, 10);
        $sedcond_date = substr($request->select_date, 12, 20);
        $onset_date = Carbon::parse($first_date)->format('Y-m-d');
        $end_date = Carbon::parse($sedcond_date)->format('Y-m-d');

        $check_exists_auth = client_authorization::where('authorization_number', $request->authorization_number)
            ->where('client_id', $request->client_id)
            ->where('admin_id', Auth::user()->admin_id)->first();

        if ($check_exists_auth) {
            return back()->with('alert', 'This Authorization Already Exists');
        } else {
            $new_authorization = new client_authorization();
            if ($request->hasFile('upload_authorization')) {

                $image = $request->file('upload_authorization');
                $name = $image->getClientOriginalName();
                $uploadPath = 'assets/dashboard/authorization/';
                $image->move($uploadPath, $name);
                $imageUrl = $uploadPath . $name;

                $new_authorization->upload_authorization = $imageUrl;
            }


            $payo_data = All_payor::where('id', $request->payor_id)->first();

            if ($payo_data) {
                $payor_name = $payo_data->payor_name;
            } else {
                $payor_name = '';
            }

            $new_authorization->admin_id = Auth::user()->admin_id;
            $new_authorization->authorization_name = $payor_name . ' ' . $request->treatment_type;
            $new_authorization->client_id = $request->client_id;
            $new_authorization->description = $request->description;
            $new_authorization->payor_id = $request->payor_id;
            $new_authorization->treatment_type = $request->treatment_type;
            $new_authorization->supervisor_id = $request->supervisor_id;
            $new_authorization->onset_date = $onset_date;
            $new_authorization->end_date = $end_date;
            $new_authorization->selected_date = $date;
            $new_authorization->authorization_number = $request->authorization_number;
            $new_authorization->uci_id = $request->uci_id;
            $new_authorization->max_total_auth = $request->max_total_auth;
            $new_authorization->value = $request->value;
            $new_authorization->diagnosis_one = $request->diagnosis_one;
            $new_authorization->diagnosis_two = $request->diagnosis_two;
            $new_authorization->diagnosis_three = $request->diagnosis_three;
            $new_authorization->diagnosis_four = $request->diagnosis_four;
            $new_authorization->deductible = $request->deductible;
            $new_authorization->in_network = $request->in_network;
            $new_authorization->copay = $request->copay;
            $new_authorization->cms_four = $request->cms_four;
            $new_authorization->csm_eleven = $request->csm_eleven;
            $new_authorization->notes = $request->notes;
            if ($request->is_primary != null || $request->is_primary != "") {
                $new_authorization->is_primary = $request->is_primary;
            }

            $new_authorization->is_placeholder = $request->is_placeholder;
            $new_authorization->is_valid = $request->is_valid;
            $new_authorization->save();


            Client_activity::create([
                'admin_id' => Auth::user()->admin_id,
                'client_id' => $new_authorization->client_id,
                'title' => "Patient Authorization Created",
                'message' => "Patient Authorization Created",
                'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);


            return redirect(route('provider.client.authorization', $request->client_id))->with('success', 'Authorization Created Successfully');
        }

    }


    public function patient_authorization_edit($id)
    {
        $edit_authorization = client_authorization::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $client_id = Client::where('id', $edit_authorization->client_id)->where('admin_id', Auth::user()->admin_id)->first();
        $activities = Client_authorization_activity::where('authorization_id', $id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(15);
        $cpt_cores = setting_cpt_code::where('admin_id', Auth::user()->admin_id)->get();
        $all_payors = payor_facility::where('admin_id', Auth::user()->admin_id)->get();
        $supervisor = Employee_department::where('is_supervisor', 1)->where('admin_id', Auth::user()->admin_id)->get();
        $treatment_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->get();
        $all_sub_acts = all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        return view('provider.client.clientAuthorizationEdit', compact('client_id', 'edit_authorization', 'activities', 'cpt_cores', 'all_payors', 'supervisor', 'treatment_types', 'all_sub_acts'));
    }


    public function patient_authorization_update(Request $request)
    {
        $date = $request->select_date;
        $first_date = substr($request->select_date, 0, 10);
        $sedcond_date = substr($request->select_date, 12, 20);
        $onset_date = Carbon::parse($first_date)->format('Y-m-d');
        $end_date = Carbon::parse($sedcond_date)->format('Y-m-d');


        $update_authorization = client_authorization::where('id', $request->edit_authorization_id)->where('admin_id', Auth::user()->admin_id)->first();

        if ($request->hasFile('upload_authorization')) {
            @unlink($update_authorization->upload_authorization);
            $image = $request->file('upload_authorization');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/authorization/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $update_authorization->upload_authorization = $imageUrl;
        }


        $payo_data = All_payor::where('id', $request->payor_id)->first();

        if ($payo_data) {
            $payor_name = $payo_data->payor_name;
        } else {
            $payor_name = '';
        }


        $update_authorization->authorization_name = $payor_name . ' ' . $request->treatment_type;
        $update_authorization->client_id = $request->client_id;
        $update_authorization->description = $request->description;
        $update_authorization->payor_id = $request->payor_id;
        $update_authorization->treatment_type = $request->treatment_type;
        $update_authorization->supervisor_id = $request->supervisor_id;
        $update_authorization->onset_date = $onset_date;
        $update_authorization->end_date = $end_date;
        $update_authorization->selected_date = $date;
        $update_authorization->authorization_number = $request->authorization_number;
        $update_authorization->uci_id = $request->uci_id;
        $update_authorization->max_total_auth = $request->max_total_auth;
        $update_authorization->value = $request->value;
        $update_authorization->diagnosis_one = $request->diagnosis_one;
        $update_authorization->diagnosis_two = $request->diagnosis_two;
        $update_authorization->diagnosis_three = $request->diagnosis_three;
        $update_authorization->diagnosis_four = $request->diagnosis_four;
        $update_authorization->deductible = $request->deductible;
        $update_authorization->in_network = $request->in_network;
        $update_authorization->copay = $request->copay;
        $update_authorization->cms_four = $request->cms_four;
        $update_authorization->csm_eleven = $request->csm_eleven;
        $update_authorization->notes = $request->notes;
        if ($request->is_primary != null || $request->is_primary != "") {
            $update_authorization->is_primary = $request->is_primary;
        }

        $update_authorization->is_placeholder = $request->is_placeholder;
        $update_authorization->is_valid = $request->is_valid;
        $update_authorization->save();


        if ($request->is_placeholder != 1) {
            Appoinment::where('authorization_id', $update_authorization->id)->update(['is_show' => 0]);
        } else {
            Appoinment::where('authorization_id', $update_authorization->id)->update(['is_show' => 1]);
        }

        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $update_authorization->client_id,
            'title' => "Client Authorization Updated",
            'message' => "Client Authorization Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Authorization Updated Successfully');
    }


    public function patient_authorization_delete($id)
    {
        $del_auth = client_authorization::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $check_app = Appoinment::where('authorization_id', $del_auth->id)->count();
        if ($check_app > 0) {
            return back()->with('alert', 'Authorization have active billing');
            exit();
        }
        client_authorization_activity::where('authorization_id', $id)->where('admin_id', Auth::user()->admin_id)->delete();
        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $del_auth->client_id,
            'message' => "Client Authorization Deleted",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);
        $del_auth->delete();


        return back()->with('success', 'Authorization Deleted Successfully');
    }


    public function patient_activity_save(Request $request)
    {
        $auth = Client_authorization::where('id', $request->authrization_id)->where('admin_id', Auth::user()->admin_id)->first();
        $d_name = $request->activity_one . $request->activity_two . $request->cpt_code;
        $check_exist = Client_authorization_activity::where('client_id', $request->client_id)
            ->where('admin_id', Auth::user()->admin_id)
            ->where('authorization_id', $request->authrization_id)
            ->where('dup_name', $d_name)
            ->first();

        if ($check_exist) {
            return back()->with('alert', 'Activity already exist');
            exit();
        } else {
            $new_activity = new client_authorization_activity();
            $new_activity->admin_id = Auth::user()->admin_id;
            $new_activity->dup_name = $d_name;
            $new_activity->activity_name = $request->activity_one . ' ' . $request->activity_two;
            $new_activity->client_id = $request->client_id;
            $new_activity->authorization_id = $request->authrization_id;
            $new_activity->activity_one = $request->activity_one;
            $new_activity->activity_two = $request->activity_two;
            $new_activity->cpt_code = $request->cpt_code;
            $new_activity->onset_date = $auth->onset_date;
            $new_activity->end_date = $auth->end_date;
            $new_activity->m1 = $request->m1;
            $new_activity->m2 = $request->m2;
            $new_activity->m3 = $request->m3;
            $new_activity->m4 = $request->m4;
            $new_activity->auth_activity = $request->auth_activity;
            $new_activity->billed_type = $request->billed_type;
            $new_activity->billed_time = $request->billed_time;
            $new_activity->rate = number_format($request->rate, 2);
            $new_activity->hours_max_one = $request->hours_max_one;
            $new_activity->hours_max_per_one = $request->hours_max_per_one;
            $new_activity->hours_max_is_one = $request->hours_max_is_one;
            $new_activity->hours_max_two = $request->hours_max_two;
            $new_activity->hours_max_per_two = $request->hours_max_per_two;
            $new_activity->hours_max_is_two = $request->hours_max_is_two;
            $new_activity->hours_max_three = $request->hours_max_three;
            $new_activity->hours_max_per_three = $request->hours_max_per_three;
            $new_activity->hours_max_is_three = $request->hours_max_is_three;
            $new_activity->notes = $request->notes;
            $new_activity->save();


            Client_activity::create([
                'admin_id' => Auth::user()->admin_id,
                'client_id' => $auth->client_id,
                'title' => "Authorization Activity Created",
                'message' => $new_activity->activity_name . " Authorization Activity Created ",
                'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);


            return back()->with('success', 'Activity Created Successfully');
        }
    }


    public function patient_activity_update(Request $request)
    {
        $auth = Client_authorization::where('id', $request->authrization_id)->where('admin_id', Auth::user()->admin_id)->first();


        $check_numeric = is_numeric($request->rate);
        if (!$check_numeric) {
            return back()->with('alert', 'Please Add Rate Value as Number or With decimal');
        } else {
            $update_activity = client_authorization_activity::where('id', $request->edit_activity_id)->where('admin_id', Auth::user()->admin_id)->first();
            $update_activity->activity_name = $request->activity_one . ' ' . $request->activity_two;
            $update_activity->activity_one = $request->activity_one;
            $update_activity->activity_two = $request->activity_two;
            $update_activity->cpt_code = $request->cpt_code;
            $update_activity->onset_date = $auth->onset_date;
            $update_activity->end_date = $auth->end_date;
            $update_activity->m1 = $request->m1;
            $update_activity->m2 = $request->m2;
            $update_activity->m3 = $request->m3;
            $update_activity->m4 = $request->m4;
            $update_activity->auth_activity = $request->auth_activity;
            $update_activity->billed_type = $request->billed_type;
            $update_activity->billed_time = $request->billed_time;
            $update_activity->rate = number_format($request->rate, 2);
            $update_activity->hours_max_one = $request->hours_max_one;
            $update_activity->hours_max_per_one = $request->hours_max_per_one != null ? $request->hours_max_per_one : $update_activity->hours_max_per_one;
            $update_activity->hours_max_is_one = $request->hours_max_is_one != null ? $request->hours_max_is_one : $update_activity->hours_max_is_one;
            $update_activity->hours_max_two = $request->hours_max_two != null ? $request->hours_max_two : $update_activity->hours_max_two;
            $update_activity->hours_max_per_two = $request->hours_max_per_two;
            $update_activity->hours_max_is_two = $request->hours_max_is_two;
            $update_activity->hours_max_three = $request->hours_max_three;
            $update_activity->hours_max_per_three = $request->hours_max_per_three;
            $update_activity->hours_max_is_three = $request->hours_max_is_three;
            $update_activity->notes = $request->notes;
            $update_activity->save();

            Client_activity::create([
                'admin_id' => Auth::user()->admin_id,
                'client_id' => $auth->client_id,
                'title' => "Authorization Activity Created",
                'message' => $update_activity->activity_name . " Authorization Activity Updated ",
                'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);


            return back()->with('success', 'Activity Updated Successfully');
        }
    }


    public function patient_activity_delete($id)
    {
        $del_activity = client_authorization_activity::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $del_activity->client_id,
            'title' => "Authorization Activity Deleted",
            'message' => $del_activity->activity_name . " Authorization Activity Deleted ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);
        $del_activity->delete();


        return back()->with('success', 'Activity Deleted Successfully');
    }


    public function patient_copy_contact_rate(Request $request)
    {
        $rat_ids = $request->array;

        $auth_data = Client_authorization::where('id', $request->auth_id)->first();
        $rate_list = rate_list::whereIn('id', $rat_ids)->get();

        if (count($rate_list) <= 0) {
            return response()->json('not fine', 200);
            exit();
        } else {
            foreach ($rate_list as $list) {
                $check_exists = Client_authorization_activity::where('admin_id', Auth::user()->admin_id)
                    ->where('authorization_id', $auth_data->id)
                    ->where('rate_id', $list->id)
                    ->first();

                if (!$check_exists) {
                    $sub_act = all_sub_activity::where('admin_id', Auth::user()->admin_id)->where('id', $list->sub_activity)->first();
                    $service = setting_service::where('id', $list->activity_type)->first();
                    if ($sub_act) {
                        $sub_activity_name = $sub_act->sub_activity;
                        $sub_activity_id = $sub_act->sub_activity;
                    } else {
                        $sub_activity_name = '';
                    }

                    if ($service) {
                        $service_name = $service->description;
                    } else {
                        $service_name = '';
                    }

                    $cpt = setting_cpt_code::where('id', $list->cpt_code)->where('admin_id', Auth::user()->admin_id)->first();

                    if ($cpt) {
                        $cpt_code = $cpt->cpt_id;
                    } else {
                        $cpt_code = '';
                    }


                    $cpt = setting_service::where('admin_id', Auth::user()->admin_id)->where('id', $list->cpt_code)->first();

                    $new_client_act = new Client_authorization_activity();
                    $new_client_act->admin_id = Auth::user()->admin_id;
                    $new_client_act->client_id = $auth_data->client_id;
                    $new_client_act->rate_id = $list->id;
                    $new_client_act->dup_name = $service_name . $sub_activity_name . $cpt_code;
                    $new_client_act->activity_name = $service_name;
                    $new_client_act->authorization_id = $request->auth_id;
                    $new_client_act->activity_one = $service_name;
                    $new_client_act->activity_two = $sub_activity_name;
                    $new_client_act->cpt_code = $cpt_code;
                    $new_client_act->onset_date = Carbon::parse($auth_data->onset_date)->format('Y-m-d');
                    $new_client_act->end_date = Carbon::parse($auth_data->end_date)->format('Y-m-d');
                    $new_client_act->m1 = $list->m1;
                    $new_client_act->m2 = $list->m2;
                    $new_client_act->m3 = $list->m3;
                    $new_client_act->m4 = $list->m4;
                    $new_client_act->billed_type = $list->rate_type;
                    $new_client_act->billed_time = $list->rate_per;
                    $new_client_act->rate = $list->billed_rate;
                    $new_client_act->save();
                }
            }


            Client_activity::create([
                'admin_id' => Auth::user()->admin_id,
                'client_id' => $auth_data->client_id,
                'title' => "Client Auhorization Activity copied from Rate List",
                'message' => "Client Auhorization Activity copied from Rate List",
                'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
            ]);


//            return response()->json('done', 200);
            return back()->with('success', 'Contract Rate Successfully Copied');


        }
    }


    public function get_sub_type_tx_type(Request $request)
    {
        $t_type = $request->treatment_type;
        $trett_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->where('treatment_name', $t_type)->get();

        $array = [];

        foreach ($trett_types as $types) {
            array_push($array, $types->id);
        }

        $sub_acts = all_sub_activity::whereIn('facility_treatment_id', $array)->where('admin_id', Auth::user()->admin_id)->get();

        return response()->json($sub_acts, 200);
    }


    public function get_service_tx_type(Request $request)
    {
        $t_type = $request->treatment_type;
        $trett_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->where('treatment_name', $t_type)->get();

        $array = [];
        foreach ($trett_types as $types) {
            array_push($array, $types->id);
        }

        $sett_ser = setting_service::whereIn('facility_treatment_id', $array)->where('admin_id', Auth::user()->admin_id)->get();

        return response()->json($sett_ser, 200);
    }


    public function get_cpt_codes_tx_type(Request $request)
    {
        $t_type = $request->treatment_type;
        $trett_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->where('treatment_name', $t_type)->get();
        $array = [];
        foreach ($trett_types as $types) {
            array_push($array, $types->id);
        }

        $settingcpt_code_get = setting_cpt_code::whereIn('facility_treatment_id', $array)
            ->where('admin_id', Auth::user()->admin_id)
            ->get();

        return response()->json($settingcpt_code_get, 200);
    }


    public function get_authdata_by_act(Request $request)
    {
        $act = Client_authorization_activity::where('id', $request->act_data)->first();
        $auth = Client_authorization::where('id', $act->authorization_id)->first();
        return response()->json($act, 200);
    }


    public function patient_document($id)
    {
        $client_id = Client::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $docuemtnts = Client_document::where('client_id', $id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(10);
        return view('provider.client.clientDocument', compact('client_id', 'docuemtnts'));
    }


    public function patient_document_save(Request $request)
    {
        $client_document = new client_document();
        if ($request->hasFile('file_name')) {
            $image = $request->file('file_name');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/documents/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $client_document->file_name = $imageUrl;
        }

        $client_document->admin_id = Auth::user()->admin_id;
        $client_document->client_id = $request->client_id;
        $client_document->description = $request->description;
        $client_document->exp_date = $request->exp_date;
        $client_document->created_by = Auth::user()->full_name;
        $client_document->save();

        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $client_document->client_id,
            'title' => "Client Document Deleted",
            'message' => " Client Document Created ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);


        return back()->with('success', 'Document Uploaded Successfully');
    }


    public function patient_document_update(Request $request)
    {
        $update_document = client_document::where('id', $request->edit_doc)->where('admin_id', Auth::user()->admin_id)->first();
        if ($request->hasFile('file_name')) {
            unlink($update_document->file_name);
            $image = $request->file('file_name');
            $name = $image->getClientOriginalName();
            $uploadPath = 'assets/dashboard/documents/';
            $image->move($uploadPath, $name);
            $imageUrl = $uploadPath . $name;

            $update_document->file_name = $imageUrl;
        }
        $update_document->description = $request->description;
        $update_document->exp_date = $request->exp_date;
        $update_document->save();

        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $update_document->client_id,
            'title' => "Client Document Updated",
            'message' => " Client Document Updated ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Document Updated Successfully');
    }


    public function patient_document_delete($id)
    {
        $client_document_delete = client_document::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $client_document_delete->client_id,
            'title' => "Client Document Deleted",
            'message' => " Client Document Deleted ",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);
        @unlink($client_document_delete->file_name);
        $client_document_delete->delete();


        return back()->with('success', 'Document Deleted Successfully');
    }


    public function patient_portal($id)
    {
        $client_id = client::where('id', $id)->first();
        $client_portal_exists = Client_portal::where('client_id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        if ($client_portal_exists) {
            $client_portal = $client_portal_exists;
        } else {
            $client_portal = new Client_portal();
            $client_portal->admin_id = Auth::user()->admin_id;
            $client_portal->client_id = $id;
            $client_portal->save();
        }
        return view('provider.client.clientPortal', compact('client_id', 'client_portal'));
    }


    public function patient_portal_save(Request $request)
    {
        $update_client_portal = client_portal::where('client_id', $request->client_id)->where('admin_id', Auth::user()->admin_id)->first();
        $update_client_portal->self_schedule_appoinment = $request->self_schedule_appoinment;
        $update_client_portal->secure_message = $request->secure_message;
        $update_client_portal->access_billing = $request->access_billing;
        $update_client_portal->pay_stripe = $request->pay_stripe;
        $update_client_portal->save();


        Client_activity::create([
            'admin_id' => Auth::user()->admin_id,
            'client_id' => $update_client_portal->client_id,
            'title' => "Client portal Updated",
            'message' => "Client portal Updated",
            'act_date' => Carbon::now()->format('Y-m-d H:m:s'),
        ]);

        return back()->with('success', 'Client Portal Updated Successfully');
    }


    public function patient_activity($id)
    {
        $client_id = Client::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $client_activities = Client_activity::where('admin_id', Auth::user()->admin_id)->where('client_id', $id)->paginate(15);
        return view('provider.client.clientActivity', compact('client_id', 'client_activities'));
    }


}
