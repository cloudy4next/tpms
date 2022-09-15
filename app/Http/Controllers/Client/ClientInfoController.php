<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\all_sub_activity;
use App\Models\Client;
use App\Models\Client_address;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_document;
use App\Models\Client_email;
use App\Models\Client_guarantar_info;
use App\Models\Client_info;
use App\Models\Client_phone;
use App\Models\Employee_department;
use App\Models\Payor_facility;
use App\Models\Rendering_provider;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location_box_two;
use App\Models\setting_service;
use App\Models\Treatment_facility;
use App\Models\zone_setup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientInfoController extends Controller
{
    public function my_info()
    {
        $client_id = Client::where('id', Auth::user()->id)->first();
        $phones = Client_phone::where('client_id', Auth::user()->id)->get();
        $emails = Client_email::where('client_id', Auth::user()->id)->get();
        $address = Client_address::where('client_id', Auth::user()->id)->get();
        $all_zone = zone_setup::all();
        $ren_providers = Rendering_provider::where('admin_id', Auth::user()->admin_id)->get();
        $client_info = Client_info::where('client_id', Auth::user()->id)->first();
        $client_garanter_info = Client_guarantar_info::where('client_id', Auth::user()->id)->first();

        if ($client_garanter_info) {
            $garanter_info = $client_garanter_info;
        } else {
            $garanter_info = new client_guarantar_info();
            $garanter_info->client_id = Auth::user()->id;
            $garanter_info->admin_id = Auth::user()->admin_id;
            $garanter_info->save();
        }

        $box_32 = setting_name_location_box_two::where('admin_id', Auth::user()->admin_id)->get();

        return view('client.info.myInfo', compact('client_id', 'phones', 'emails', 'address', 'all_zone', 'ren_providers', 'client_info', 'garanter_info', 'box_32'));
    }


    public function my_info_update(Request $request)
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


        $client = client::where('id', $request->client_edit_id)->first();

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
        $client->timezone = $request->default_tz;
        $client->zone = $request->zone;
        $client->save();


        $client_info = client_info::where('client_id', $client->id)->where('admin_id', Auth::user()->admin_id)->first();
        if ($request->hasFile('signature_image')) {

            $image = $request->file('signature_image');
            $s3 = Storage::disk('s3');
            $imageName = uniqid() . $client_info->id . time() . '.' . $image->getClientOriginalName('signature_image');
            $s3filepath = 'patient/' . $imageName;
            $s3->put($s3filepath, file_get_contents($image), 'public');
            $image_name = 'https://therapypms.s3.us-east-2.amazonaws.com/patient/' . $imageName;
            $client_info->signature_image = $image_name;
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


        return back()->with('success', 'Client Info Updated Successfully');


    }


    public function my_sign_delete(Request $request)
    {
        $delete_sign = Client_info::where('client_id', $request->client_id)->first();
        if (!empty($delete_sign->signature_image) && file_exists($delete_sign->signature_image)) {
            unlink($delete_sign->signature_image);
            return response()->json('done', 200);
        } else {
            return response()->json('not done', 200);
        }
    }


    public function my_info_phone_delete(Request $request)
    {
        $delete_phone = client_phone::where('id', $request->phonid)->where('admin_id', Auth::user()->admin_id)->first();
        $delete_phone->delete();
    }

    public function my_info_email_delete(Request $request)
    {
        $delete_email = client_email::where('id', $request->emailid)->where('admin_id', Auth::user()->admin_id)->first();
        $delete_email->delete();
    }

    public function my_info_address_delete(Request $request)
    {
        $delete_address = client_address::where('id', $request->addressid)->where('admin_id', Auth::user()->admin_id)->first();
        $delete_address->delete();
    }


    public function my_authorization()
    {
        $client_id = Client::where('id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->first();
        $all_authorizations = Client_authorization::where('client_id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(15);
        $cpt_cores = setting_cpt_code::where('admin_id', Auth::user()->admin_id)->get();
        $all_sub_acts = all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        return view('client.info.myAuthorization', compact('client_id', 'all_authorizations', 'cpt_cores', 'all_sub_acts'));
    }


    public function my_authorization_view($id)
    {
        $edit_authorization = client_authorization::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        $client_id = Client::where('id', $edit_authorization->client_id)->where('admin_id', Auth::user()->admin_id)->first();
        $activities = Client_authorization_activity::where('authorization_id', $id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(15);
        $cpt_cores = setting_cpt_code::where('admin_id', Auth::user()->admin_id)->get();
        $all_payors = Payor_facility::where('admin_id', Auth::user()->admin_id)->get();
        $supervisor = Employee_department::where('is_supervisor', 1)->where('admin_id', Auth::user()->admin_id)->get();
        $treatment_types = Treatment_facility::where('admin_id', Auth::user()->admin_id)->get();
        $all_sub_acts = all_sub_activity::where('admin_id', Auth::user()->admin_id)->get();
        return view('client.info.myAuthorizationEdit', compact('edit_authorization', 'client_id', 'activities', 'cpt_cores', 'all_payors', 'supervisor', 'treatment_types', 'all_sub_acts'));
    }


    public function my_authorization_get_subtype_tx(Request $request)
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


    public function my_authorization_get_service_tx(Request $request)
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


    public function my_authorization_get_cpt_tx(Request $request)
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


    public function my_authorization_get_authdata_act(Request $request)
    {
        $act = Client_authorization_activity::where('id', $request->act_data)->first();
        $auth = Client_authorization::where('id', $act->authorization_id)->first();
        return response()->json($act, 200);
    }


    public function my_documents()
    {
        $client_id = Client::where('id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->first();
        $docuemtnts = Client_document::where('client_id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->orderBy('id', 'desc')->paginate(10);
        return view('client.info.myDocuments', compact('client_id', 'docuemtnts'));
    }

    public function my_documents_upload(Request $request)
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
        $client_document->created_by = Auth::user()->client_full_name;
        $client_document->save();

        return back()->with('success', 'Document Uploaded Successfully');

    }

    public function my_documents_update(Request $request)
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
        return back()->with('success', 'Document Updated Successfully');
    }


    public function my_documents_delete($id)
    {
        $client_document_delete = client_document::where('id', $id)->where('admin_id', Auth::user()->admin_id)->first();
        @unlink($client_document_delete->file_name);
        $client_document_delete->delete();
        return back()->with('success', 'Document Deleted Successfully');
    }


}
