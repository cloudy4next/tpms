<?php

namespace App\Jobs;

use App\GoogleService;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateAllExistAppoinment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $new_apponinemt;
    public $timezone;
    public $user_type;

    public function __construct($new_apponinemt,$timezone,$user_type)
    {
        $this->new_apponinemt = $new_apponinemt;
        $this->timezone=$timezone;
        $this->user_type=$user_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $evn_is_update = 'create';
        $all_app = $this->new_apponinemt;
//        $event = Appoinment::select('id', 'admin_id', 'g_event_id', 'client_id', 'from_time', 'to_time')->where('id', $singe_app->id)->first();

        $events = $this->new_apponinemt;
        $event = Appoinment::select('id', 'admin_id', 'g_event_id','pg_event_id' 'client_id', 'provider_id', 'from_time', 'to_time', 'status')
            ->where('id', $events->id)
            ->first();

        if ($event) {
            if($this->user_type=="admin"){
                $event->g_event_id = 'done';
            }
            else{
                $event->pg_event_id = 'done';
            }
            $event->save();
            $g_service = new GoogleService(Auth::user(),$this->user_type);
            $is_google_token_expired = $g_service->is_google_token_expired();
            if (!$is_google_token_expired) {
                try {
                    $client = $g_service->google_client();
                    $service = new \Google_Service_Calendar($client);
                    $google_data = $this->set_data_according_google_calendar($event);
                    $googleEvent = new \Google_Service_Calendar_Event($google_data);
                    if ($evn_is_update == 'create') {
                        $ev_id = $service->events->insert($this->googleCalendarId(), $googleEvent);
                        $app_update = Appoinment::select('id', 'g_event_id','pg_event_id')->where('id', $event->id)->first();

                        if ($app_update) {
                            if($this->user_type=="admin"){
                                $app_update->g_event_id = $ev_id->id;
                            }
                            else{
                                $app_update->pg_event_id = $ev_id->id;
                            }
                            $app_update->save();
                        }
                    } else {
                        if($this->user_type=="admin"){
                            $ev_id = $service->events->update($this->googleCalendarId(), $event->g_event_id, $googleEvent);
                        }
                        else{
                            $ev_id = $service->events->update($this->googleCalendarId(), $event->pg_event_id, $googleEvent);
                        }
                    }

                    return true;
                } catch (Exception $ex) {
                    return false;
                }
            }
        }


    }

    public function set_data_according_google_calendar($event)
    {

        $tz=$this->timezone;
        $client = Client::select('id', 'admin_id', 'client_first_name', 'client_last_name')
            ->where('id', $event->client_id)
            ->where('admin_id', $event->admin_id)
            ->first();


        if ($client) {
            $cli_name = substr($client->client_last_name, 0, 2) . ' ' . substr($client->client_first_name, 0, 2);
        } else {
            $cli_name = '';
        }

        $provider_name = Employee::select('id', 'admin_id', 'first_name', 'last_name')
            ->where('id', $event->provider_id)
            ->where('admin_id', $event->admin_id)
            ->first();

        if ($provider_name) {
            $pro_name = substr($provider_name->last_name, 0, 2) . ' ' . substr($provider_name->first_name, 0, 2) . ' : ';
        } else {
            $pro_name = '';
        }


        $name = $pro_name . $pro_name;

        $google_data = array();
        if (isset($event->client_id)) {
            $google_data['summary'] = $name;
        }
        if (isset($event->from_time)) {
            $start=$event->from_time;
            $start=Carbon::parse($start,$tz)->toIso8601String();

            $google_data['start'] = array(
                'dateTime' => $start,
                'timeZone' => $tz,
            );
        }
        if (isset($event->to_time)) {
            $end=$event->to_time;
            $end=Carbon::parse($end,$tz)->toIso8601String();

            $google_data['end'] = array(
                'dateTime' => $end,
                'timeZone' => $tz,
            );
        }
        if (isset($event->description)) {
            $google_data['description'] = $event->description;
        }
        if (isset($event->public)) {
            $google_data['visibility'] = "public";
        } else {
            $google_data['visibility'] = "private";
        }
        return $google_data;
    }

    public function googleCalendarId()
    {
        return "primary";
    }
}
