<?php
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Appoinment;
use Illuminate\Support\Facades\Mail;
use App\Mail\sessionReminder;

$today=Carbon::now('EST')->format('Y-m-d');
$appointments=Appoinment::select('client_id')->distinct()->where('schedule_date',$today)->get();

foreach($appointments as $appoint){
	$app=Appoinment::where('id',$appoint->id)->first();

	$client=Client::where('id',$appoint->client_id)->first();

	$arr=array(
		"schedule_date"=>Carbon::parse($app->schedule_date)->format('d-m-Y'),
		"from_time"=>Carbon::parse($app->from_time)->format('g:i A'),
		"to_time"=>Carbon::parse($app->to_time)->format('g:i A'),
	);

    Mail::to($client->email)->send(new sessionReminder($arr));

}

?>