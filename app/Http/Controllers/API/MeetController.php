<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization_activity;
use App\Models\meet_link;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    public function show_meet_url($meet_id)
    {

        $meet_link = meet_link::select('id', 'admin_id', 'session_id', 'meet_url', 'is_end', 'video_url', 'room_name')->where('meet_url', $meet_id)->first();

        if ($meet_link) {
            $session = Appoinment::select('id', 'admin_id', 'client_id', 'authorization_activity_id', 'location', 'schedule_date')->where('id', $meet_link->session_id)->first();

            if ($session) {
                $client_name = Client::select('id', 'client_full_name')->where('id', $session->client_id)->first();
                $act = Client_authorization_activity::select('id', 'activity_name')->where('id', $session->authorization_activity_id)->first();
            }
        }

        if ($meet_link) {
            return response()->json([
                'status' => 'success',
                'message' => 'meet url get success',
                'room_name' => $meet_link->room_name,
                'pt_name' => isset($client_name) ? $client_name->client_full_name : '',
                'service' => isset($act) ? $act->activity_name : '',
                'pos' => 'Telehealth (02)',
                'dos' => isset($session) ? Carbon::parse($session->schedule_date)->format('m/d/Y') : '',
                'meet_url_id' => $meet_link->meet_url
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'not meet link found',
                'room_name' => '',
                'meet_url' => null
            ]);
        }

    }


    public function end_meet($meet_id)
    {
        $meet_link = meet_link::select('id', 'meet_url', 'is_end', 'video_url')->where('meet_url', $meet_id)->first();
        $meet_link->is_end = 1;
        $meet_link->save();

        return response()->json([
            'status' => 'success',
            'message' => 'meet ended',
        ]);

    }

}
