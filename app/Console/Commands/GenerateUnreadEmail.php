<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Mail\UnreadMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class GenerateUnreadEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:unreadMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email unread messeges to all';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $unreadChat = DB::table('chats')
                ->leftJoin('messages', 'chats.id', '=', 'messages.chat_id')
                ->where('messages.status', '=', 'unread')->where(
                    DB::raw('TIMESTAMPDIFF(MINUTE, messages.msg_time, NOW())'),
                    '>',
                    '10'
                )->where(
                    DB::raw('TIMESTAMPDIFF(HOUR, messages.updated_at, NOW())'),
                    '<',
                    '48'
                )->select('chat_id')->distinct()->get()->toArray();

            // looping through every disctric chat id
            foreach ($unreadChat as  $value) {
                $details = (array) null;
                $toDelete = (array) null;

                $chatInfo = DB::table('chats')->select('*')->where('id', '=', $value->chat_id)->first();

                $checkEmailDate = DB::table('chats')
                    ->leftJoin('messages', 'chats.id', '=', 'messages.chat_id')
                    ->where('messages.status', '=', 'unread')->where(
                        DB::raw('TIMESTAMPDIFF(MINUTE, messages.msg_time, NOW())'),
                        '>',
                        '10'
                    )->where(
                        DB::raw('TIMESTAMPDIFF(HOUR, messages.updated_at, NOW())'),
                        '<',
                        '48'
                    )->orderBy('messages.updated_at', 'desc')->first();

                // get all unread message from chat
                // $unreadMnumber = DB::table('messages')->where('messages.status', '=', 'unread')
                //     ->where('messages.chat_id', '=', $checkEmailDate->chat_id)->orderByDesc('id')->get();

                // if unread message is more than 1
                // list all unread message & delete without last item
                // if (count($unreadMnumber) > 1) {
                //     foreach ($unreadMnumber as $num) {
                //         array_push($toDelete, $num->id);
                //     }

                //     array_shift($toDelete);

                //     DB::table('messages')->where('messages.status', '=', 'unread')->whereIn('id', $toDelete)->delete();
                // }

                // Get from user to send user detail's
                if ($chatInfo->from_user_type == 'patient') {

                    $from = DB::table('clients')->select('client_full_name')->where('id', '=', $chatInfo->from_user_id)->first();

                    $fromName = $from->client_full_name;
                    if ($chatInfo->to_user_type = 'admin') {

                        $touser = DB::table('admins')->select('email', 'name')->where('id', $chatInfo->to_user_id)->first();
                        $toname = $touser->name;
                        $toemail = $touser->email;
                    } else {

                        $touser = DB::table('employees')->select('office_email', 'full_name')->where('id', $chatInfo->to_user_id)->first();
                        $toname = $touser->first_name;
                        $toemail = $touser->office_email;
                    }
                    array_push($details, $toname, $fromName);
                } elseif ($chatInfo->from_user_type == 'admin') {

                    $from = DB::table('admins')->select('name')->where('id', '=', $chatInfo->from_user_id)->first();
                    $fromName = $from->name;

                    if ($chatInfo->to_user_type == 'patient') {
                        $touser = DB::table('clients')->select('client_full_name', 'login_email')->where('id', '=', $chatInfo->to_user_id)->first();

                        $toname = $touser->client_full_name;
                        $toemail = $touser->login_email;
                    } else {

                        $touser = DB::table('employees')->select('office_email')->where('id', $chatInfo->to_user_id)->first();
                        $toname = $touser->first_name;
                        $toemail = $touser->office_email;
                    }
                    array_push($details, $toname, $fromName);
                } else {

                    $from = DB::table('employees')->select('office_email')->where('id', '=', $chatInfo->from_user_id)->first();
                    $fromName = $from->first_name;

                    if ($chatInfo->to_user_type == 'patient') {
                        $touser = DB::table('clients')->select('client_full_name', 'login_email')->where('id', '=', $chatInfo->to_user_id)->first();

                        $toname = $touser->client_full_name;
                        $toemail = $touser->login_email;
                    } else {

                        $touser = DB::table('admin')->select('office_email')->where('id', $chatInfo->to_user_id)->first();
                        $toname = $touser->first_name;
                        $toemail = $touser->office_email;
                    }
                    array_push($details, $toname, $fromName);
                }

                //checking mail sent date if date is today continue to new one
                $date = Carbon::parse($checkEmailDate->mail_sent_date);

                if ($checkEmailDate->mail_sent_date == NULL && $checkEmailDate->mail_sent == NULL) {

                    Mail::to($toemail)->send(new UnreadMessageMail($details));
                    DB::table('messages')->where('id', $checkEmailDate->id)->update(array('mail_sent' => '1', 'mail_sent_date' => Carbon::now()));
                } elseif ($date->isToday() == true && $checkEmailDate->mail_sent == 1) {

                    continue;
                } elseif ($date->isYesterday() == true) {

                    Mail::to($toemail)->send(new UnreadMessageMail($details));
                    DB::table('messages')->where('id', $checkEmailDate->id)->update(array('mail_sent' => '2', 'mail_sent_date' => Carbon::now()));
                } elseif ($checkEmailDate->mail_sent == 2) {

                    Mail::to($toemail)->send(new UnreadMessageMail($details));
                    DB::table('messages')->where('id', $checkEmailDate->id)->update(array('mail_sent' => '3', 'mail_sent_date' => Carbon::now()));
                } else {

                    continue;
                }
            }
        } catch (\Throwable $th) {
            // throw $th;
            echo ($th);
        }
    }
}
