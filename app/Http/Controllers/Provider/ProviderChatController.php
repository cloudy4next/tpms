<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\GoogleService;
use App\Jobs\UpdateAllExistAppoinment;
use App\Models\Appoinment;
use App\Models\Client;
use App\Models\Client_authorization;
use App\Models\Client_authorization_activity;
use App\Models\Client_info;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Chat;
use App\Models\Message;
use App\Models\setting_cpt_code;
use App\Models\setting_name_location;
use App\Models\msg_attachment;
use App\Models\admin_profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Cache;


class ProviderChatController extends Controller
{
    protected $u_type='provider';
    protected $del_check;
    protected $colors=["bg-primary","bg-orange","bg-info","bg-dark","bg-secondary","bg-success","bg-danger"];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->del_check=['both',Auth::user()->id.'-provider'];
            return $next($request);
        });
    }

    public function view_chat_page(){
        return view('provider.chat.chat');
    }

    public function existing_chats(Request $request){
        $lc_time=$request->lc_time;

        $lc=Chat::whereNotIn('is_del',$this->del_check)->where(function($query){
            $query->where(function($q){
                $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type);
            })->orWhere(function($q){
                $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type);
            });
        })->orderBy('updated_at','DESC')->first();

        if(!$lc){
            return response()->json([
                "lc_time"=>$lc_time,
                "chats"=>[],
                "status"=>"no_chat"
            ]);
        }
        $lc_t=$lc->updated_at;
        $lc_t=Carbon::parse($lc_t)->format('Y-m-d H:i:s');
        if($lc_t>$lc_time){

            $chats=Chat::whereNotIn('is_del',$this->del_check)->where(function($query){
                $query->where(function($q){
                    $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type);
                })->orWhere(function($q){
                    $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type);
                });
            })->orderBy('updated_at','DESC')->limit(5)->get();
            
            $i=0;
            $res=[];
            foreach($chats as $chat){
                if($chat->from_user_id==Auth::user()->id && $chat->from_user_type==$this->u_type){
                    $to_user_id=$chat->to_user_id;
                    $to_user_type=$chat->to_user_type;
                    if($to_user_type=='admin'){
                        $u_d=Admin::where('id',$to_user_id)->first();
                        $name=$u_d->name;
                        $admin_pro=admin_profile::where('admin_id',$to_user_id)->first();
                        if($admin_pro){
                            if($admin_pro->profile_photo==null){
                                $profile='';
                            }
                            else{
                                $profile=$admin_pro->profile_photo;
                            }
                            $profile_color=$admin_pro->profile_color;
                        }
                        else{
                            $profile='';
                        }
                        $check='online-'.$u_d->id.'-'.$u_d->email;
                    }
                    else if($to_user_type=='provider'){
                        $u_d=Employee::where('id',$to_user_id)->first();
                        $name=$u_d->full_name;
                        $profile=$u_d->profile_photo;
                        if($profile==null)  $profile='';
                        $profile_color=$u_d->profile_color;
                        $check='online-'.$u_d->id.'-'.$u_d->login_email;
                    }
                    else if($to_user_type=='patient'){
                        $u_d=Client::where('id',$to_user_id)->first();
                        $name=$u_d->client_full_name;
                        $profile=$u_d->profile_photo;
                        if($profile==null)  $profile='';
                        $profile_color=$u_d->profile_color;
                        $check='online-'.$u_d->id.'-'.$u_d->login_email;
                    }
                }
                else{
                    $from_user_id=$chat->from_user_id;
                    $from_user_type=$chat->from_user_type;
                    if($from_user_type=='admin'){
                        $u_d=Admin::where('id',$from_user_id)->first();
                        $name=$u_d->name;
                        $admin_pro=admin_profile::where('id',$from_user_id)->first();
                        if($admin_pro){
                            if($admin_pro->profile_photo==null){
                                $profile='';
                            }
                            else{
                                $profile=$admin_pro->profile_photo;
                            }
                            $profile_color=$admin_pro->profile_color;
                        }
                        else{
                            $profile='';
                        }
                        $check='online-'.$u_d->id.'-'.$u_d->email;
                    }
                    else if($from_user_type=='provider'){
                        $u_d=Employee::where('id',$from_user_id)->first();
                        $name=$u_d->full_name;
                        $profile=$u_d->profile_photo;
                        if($profile==null)  $profile='';
                        $profile_color=$u_d->profile_color;

                        $check='online-'.$u_d->id.'-'.$u_d->login_email;
                    }
                    else if($from_user_type=='patient'){
                        $u_d=Client::where('id',$from_user_id)->first();
                        $name=$u_d->client_full_name;
                        $profile=$u_d->profile_photo;
                        if($profile==null)  $profile='';
                        $profile_color=$u_d->profile_color;

                        $check='online-'.$u_d->id.'-'.$u_d->login_email;
                    }

                }

                if(Cache::has($check)){
                    $status="online";
                }
                else{
                    $status="offline";
                }

                $tz=Employee::select('timezone')->where('id',Auth::user()->id)->first();
                if($tz){
                    $tz=$tz->timezone;
                    if($tz==null){
                        $tz='EST';
                    }
                }
                else{
                    $tz='EST';
                }


                $msg=Message::where('chat_id',$chat->id)
                ->where(function($query){
                    $query->whereNull('is_del')->orWhere(function($q){
                        $q->where('is_del','!=','both')->where('is_del','!=',Auth::user()->id.'-'.$this->u_type);
                    });
                })
                ->orderBy('msg_time','DESC')->first();
                $msgt=Carbon::parse($msg->msg_time)->timezone($tz);
                $time=Carbon::parse($msgt)->diffInMinutes(Carbon::now($tz));
                if($time>59){
                    $time=floor($time/60);
                    if($time>23){
                        $time=$time/24;
                        if($time>3){
                            $time=Carbon::parse($msg->msg_time)->format('M d');
                        }
                        else{
                            $time=(int)$time;
                            $time=$time.' day';
                        }
                    }
                    else{
                        $time=(int)$time;
                        $time=$time.' hr';
                    }
                }
                else{
                    $time=(int)$time;
                    $time=$time.' min';
                }

                $unread=Message::where('chat_id',$chat->id)->where('status','unread')->where('from_check','!=',Auth::user()->id.'-'.$this->u_type)
                ->where(function($query){
                    $query->whereNull('is_del')->orWhere(function($q){
                        $q->where('is_del','!=','both')->where('is_del','!=',Auth::user()->id.'-'.$this->u_type);
                    });
                })
                ->count();

                $fl=substr($name, 0,1);
                $fl=strtoupper($fl);
                $res[$i]["fl"]=$fl;
                $res[$i]["color"]=$profile_color;
                $res[$i]["name"]=$name;
                $res[$i]["profile"]=$profile;
                $res[$i]["status"]=$status;
                $res[$i]["msg"]=substr($msg->msg, 0,20).' ...';
                $res[$i]["time"]=$time;
                $res[$i]["ur_count"]=$unread;
                $res[$i]["chat_id"]=$msg->chat_id;

                $i++;
            }

            return response()->json([
                "lc_time"=>$lc_t,
                "chats"=>$res,
                "status"=>"new_there",
            ]);
        }
        else{
            return response()->json([
                "lc_time"=>$lc_time,
                "chats"=>[],
                "status"=>"no_new",
            ]);
        }
    }


    public function existing_msgs(Request $request){
        $chat_id=$request->id;
        $lm_id=(int)$request->lm_id;
        $lsm_id=null;
        $del_ar=[];
        $lf_load=$request->lf_load;

        $latest=Message::where('chat_id',$chat_id)->latest()->first();
        if($latest){

            if($lf_load==0){
                $lf_load=Carbon::now('UTC');
            }
            else{
                $deleted=Message::select('id','del_at')->where('chat_id',$chat_id)->where('del_at','>=',$lf_load)->where(function($q){
                    $q->where('is_del',Auth::user()->id.'-'.$this->u_type)->orWhere('is_del','both');
                })->orderBy('del_at','DESC')->get();
                $j=0;
                if(count($deleted)>0){
                    foreach($deleted as $del){
                        if($j=0){
                            $lf_load=$del->del_at;
                        }
                        array_push($del_ar, $del->id);
                        $j++;
                    }
                }
                else{
                    $lf_load=Carbon::now('UTC');
                }
            }

            if($latest->id>$lm_id){
                $msgs=Message::where('chat_id',$chat_id)->where('id','>',$lm_id)
                ->where(function($query){
                    $query->whereNull('is_del')->orWhere(function($q){
                        $q->where('is_del','!=','both')->where('is_del','!=',Auth::user()->id.'-'.$this->u_type);
                    });
                })->orderBy('msg_time','DESC')->limit(8)->get()->reverse();
                $i=0;
                $tz=Employee::select('timezone')->where('id',Auth::user()->id)->first();
                if($tz){
                    $tz=$tz->timezone;
                    if($tz==null){
                        $tz='EST';
                    }
                }
                else{
                    $tz='EST';
                }


                foreach($msgs as $msg){

                    if($lsm_id==null){
                        if($lm_id==0){
                            $lsm_id=$msg->id;
                        }
                        else{
                            $lsm_id=0;
                        }
                    }

                    if($msg->from_check==Auth::user()->id.'-'.$this->u_type){
                        $check="sent";
                        $provider_pro=Employee::where('id',Auth::user()->id)->first();
                        if($provider_pro){
                            $profile=$provider_pro->profile_photo;
                            $profile_color=$provider_pro->profile_color;
                        }
                        else{
                            $profile='';
                            $profile_color='';

                        }

                    }
                    else{
                        $check="receive";
                        $data=explode("-", $msg->from_check);
                        if($data[1]=="admin"){
                            $admin_pro=admin_profile::where('admin_id',$data[0])->first();
                            if($admin_pro){
                                $profile=$admin_pro->profile_photo;
                                $profile_color=$admin_pro->profile_color;
                            }
                            else{
                                $profile='';
                                $profile_color='';

                            }
                        }
                        else if($data[1]=="provider"){
                            $em_pro=Employee::select('profile_photo','profile_color')->where('id',$data[0])->first();
                            if($em_pro){
                                $profile=$em_pro->profile_photo;
                                $profile_color=$em_pro->profile_color;
                            }
                            else{
                                $profile='';
                                $profile_color='';

                            }
                        }
                        else if($data[1]=="patient"){
                            $c_pro=Client::select('profile_photo','profile_color')->where('id',$data[0])->first();
                            if($c_pro){
                                $profile=$c_pro->profile_photo;
                                $profile_color=$c_pro->profile_color;
                            }
                            else{
                                $profile='';
                                $profile_color='';

                            }
                        }

                    }

                    if($msg->attach!=null){
                        $attach=explode('/', $msg->attach);
                        $attach=$attach[2];
                        $short_name=substr($attach,0,15);
                        $ext=explode('.',$attach);
                        $ext=$ext[1];
                        if($ext=='jpeg' || $ext=='png' || $ext=="jpg" || $ext=='gif'){
                            $type="image";
                        }
                        else{
                            $type="file";
                        }
                    }
                    else{
                        $attach=null;
                        $short_name=null;
                        $ext=null;
                        $type=null;

                    }

                    if($msg->hyperlink!=null){
                        $hyperlink=route('provider.client.info', $msg->hyperlink);
                        $client=Client::select('client_full_name','profile_photo','profile_color')->where('id',$msg->hyperlink)->first();
                        $c_name=$client->client_full_name;
                        $res[$i]["c_name"]=$c_name;
                        $fl=substr($c_name, 0,1);
                        $fl=strtoupper($fl);
                        $res[$i]["fl"]=$fl;
                        $c_color=$client->profile_color;
                        $c_profile=$client->profile_photo;
                        if($c_profile==null)  $c_profile='';
                        $res[$i]["c_color"]=$c_color;
                        $res[$i]["c_profile"]=$c_profile;
                    }
                    else{
                        $hyperlink=null;
                    }

                    $res[$i]["color"]=$profile_color;
                    $res[$i]["msg"]=$msg->msg;
                    $res[$i]["msg_id"]=$msg->id;
                    $res[$i]["attach"]=$attach;
                    $res[$i]["hyperlink"]=$hyperlink;
                    $res[$i]["short_name"]=$short_name;
                    $res[$i]["ext"]=$ext;
                    $res[$i]["type"]=$type;
                    $res[$i]["from_check"]=$check;
                    $res[$i]["profile"]=$profile==null?'':$profile;
                    $res[$i]["msg_time"]=Carbon::parse($msg->msg_time)->timezone($tz)->format('H:i');
                    $i++;
                }

                return response()->json([
                    "lm_id"=>$latest->id,
                    "lsm_id"=>$lsm_id,
                    "msgs"=>$res,
                    "del_msg"=>$del_ar,
                    "lf_load"=>$lf_load,
                ]);
            }
            else{
                return response()->json([
                    "lm_id"=>$lm_id,
                    "lsm_id"=>0,
                    "msgs"=>[],
                    "del_msg"=>$del_ar,
                    "lf_load"=>$lf_load,
                ]);
            }
        }
        else{
            return response()->json([
                "lm_id"=>0,
                "lsm_id"=>0,
                "msgs"=>[],
                "del_msg"=>$del_ar,
                "lf_load"=>$lf_load,
            ]);
        }

        
    }

    public function scroll_msgs(Request $request){
        $chat_id=$request->id;
        $lm_id=(int)$request->lsm_id;

        if($lm_id==0){
            return response()->json([
                "lsm_id"=>0,
                "msgs"=>[]
            ]);
        }

        $msgs=Message::where('chat_id',$chat_id)->where('id','<',$lm_id)
        ->where(function($query){
            $query->whereNull('is_del')->orWhere(function($q){
                $q->where('is_del','!=','both')->where('is_del','!=',Auth::user()->id.'-'.$this->u_type);
            });
        })->orderBy('msg_time','DESC')->limit(8)->get()->reverse();

        $i=0;
        if(Auth::user()->is_up_admin==1){
            $tz=setting_name_location::select('timezone')->where('admin_id',Auth::user()->id)->first();
        }
        else{
            $tz=setting_name_location::select('timezone')->where('admin_id',Auth::user()->up_admin_id)->first();
        }
        $tz=$tz->timezone;
        if($tz==null){
            $tz='EST';
        }

        $lsm_id=null;
        if(count($msgs)>0){
            foreach($msgs as $msg){
                if($lsm_id==null){
                    $lsm_id=$msg->id;
                }

                if($msg->from_check==Auth::user()->id.'-'.$this->u_type){
                    $check="sent";
                    $provider_pro=Employee::where('id',Auth::user()->id)->first();
                    if($provider_pro){
                        $profile=$provider_pro->profile_photo;
                        $profile_color=$provider_pro->profile_color;
                    }
                    else{
                        $profile='';
                        $profile_color='';

                    }

                }
                else{
                    $check="receive";
                    $data=explode("-", $msg->from_check);
                    if($data[1]=="admin"){
                        $admin_pro=admin_profile::where('admin_id',$data[0])->first();
                        if($admin_pro){
                            $profile=$admin_pro->profile_photo;
                            $profile_color=$admin_pro->profile_color;
                        }
                        else{
                            $profile='';
                            $profile_color='';

                        }
                    }
                    else if($data[1]=="provider"){
                        $em_pro=Employee::select('profile_photo','profile_color')->where('id',$data[0])->first();
                        if($em_pro){
                            $profile=$em_pro->profile_photo;
                            $profile_color=$em_pro->profile_color;
                        }
                        else{
                            $profile='';
                            $profile_color='';

                        }
                    }
                    else if($data[1]=="patient"){
                        $c_pro=Client::select('profile_photo','profile_color')->where('id',$data[0])->first();
                        if($c_pro){
                            $profile=$c_pro->profile_photo;
                            $profile_color=$c_pro->profile_color;
                        }
                        else{
                            $profile='';
                            $profile_color='';

                        }
                    }

                }

                if($msg->attach!=null){
                    $attach=explode('/', $msg->attach);
                    $attach=$attach[2];
                    $short_name=substr($attach,0,15);
                    $ext=explode('.',$attach);
                    $ext=$ext[1];
                    if($ext=='jpeg' || $ext=='png' || $ext=="jpg" || $ext=='gif'){
                        $type="image";
                    }
                    else{
                        $type="file";
                    }
                }
                else{
                    $attach=null;
                    $short_name=null;
                    $ext=null;
                    $type=null;

                }

                if($msg->hyperlink!=null){
                    $hyperlink=route('superadmin.client.info', $msg->hyperlink);
                    $client=Client::select('client_full_name','profile_photo','profile_color')->where('id',$msg->hyperlink)->first();
                    $c_name=$client->client_full_name;
                    $res[$i]["c_name"]=$c_name;
                    $fl=substr($c_name, 0,1);
                    $fl=strtoupper($fl);
                    $res[$i]["fl"]=$fl;
                    $c_profile=$client->profile_photo;
                    $c_color=$client->profile_color;
                    if($c_profile==null)  $c_profile='';
                    if($c_color==null)  $c_color='';
                    $res[$i]["c_profile"]=$c_profile;
                    $res[$i]["c_color"]=$c_color;
                }
                else{
                    $hyperlink=null;
                }

                $res[$i]["color"]=$profile_color;
                $res[$i]["msg_id"]=$msg->id;
                $res[$i]["msg"]=$msg->msg;
                $res[$i]["attach"]=$attach;
                $res[$i]["hyperlink"]=$hyperlink;
                $res[$i]["short_name"]=$short_name;
                $res[$i]["ext"]=$ext;
                $res[$i]["type"]=$type;
                $res[$i]["from_check"]=$check;
                $res[$i]["profile"]=$profile==null?'':$profile;
                $res[$i]["msg_time"]=Carbon::parse($msg->msg_time)->timezone($tz)->format('H:i');
                $i++;
            }

            return response()->json([
                "lsm_id"=>$lsm_id,
                "msgs"=>$res
            ]);

        }
        else{
           return response()->json([
                "lsm_id"=>0,
                "msgs"=>[]
            ]); 
        }
    }


    public function send_msg(Request $request){
        $chat_id=$request->chat_id;
        $to_id=$request->to_id;
        $to_type=$request->to_type;
        $hyperlink=$request->hyper_link;
        $msg=$request->msg;
        $to_check='';

        if($chat_id==0){
            $exist_chat=Chat::whereNotIn('is_del',$this->del_check)->where(function($query) use($to_id,$to_type) {

                $query->where(function($q) use($to_id,$to_type) { 
                    $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type)->where('to_user_id',$to_id)->where('to_user_type',$to_type);
                })->orWhere(function($q) use($to_id,$to_type) {
                    $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type)->where('from_user_id',$to_id)->where('from_user_type',$to_type);
                });

            })->first();

            if($exist_chat){
                $to_check=$exist_chat->to_user_id.'-'.$exist_chat->to_user_type;
                $chat_id=$exist_chat->id;
            }
            else{
                $new_chat=new Chat();
                $new_chat->from_user_id=Auth::user()->id;
                $new_chat->from_user_type=$this->u_type;
                $new_chat->to_user_id=$to_id;
                $new_chat->to_user_type=$to_type;
                $new_chat->is_del=2;
                $new_chat->save();
                $chat_id=$new_chat->id;
                $to_check=$to_id.'-'.$to_type;
            }
        }
        else{
            $to_check_q=Chat::select('to_user_id','to_user_type','from_user_id','from_user_type')->where('id',$chat_id)->first();
            if($to_check_q->to_user_id==Auth::user()->id && $to_check_q->to_user_type==$this->u_type){
                $to_check=$to_check_q->from_user_id.'-'.$to_check_q->from_user_type;
            }
            else{
                $to_check=$to_check_q->to_user_id.'-'.$to_check_q->to_user_type;

            }
        }

        $res=new Message();
        $res->chat_id=$chat_id;
        $res->msg_time=Carbon::now('UTC');
        $res->from_check=Auth::user()->id.'-'.$this->u_type;
        if ($request->f_name!="empty") {
            $name = $request->f_name;
            $uploadPath = 'assets/chat_files/';
            $fileUrl = $uploadPath . $name;
            $res->attach = $fileUrl;

            $attach=new msg_attachment;
            $attach->from_check=Auth::user()->id.'-'.$this->u_type;
            $attach->to_check=$to_check;
            $attach->attachment=$name;
            $attach->path=$fileUrl;
            $attach->status=1;
            $attach->save();
        }

        $res->msg=$msg;
        if($hyperlink!=''){
            $res->hyperlink=$hyperlink;
        }
        $res->save();

        $touch=Chat::where('id',$chat_id)->first();
        $touch->touch();

        return response()->json([

            "status"=>"success",
            "chat_id"=>$chat_id

        ]);
    }


    public function update_read_status(Request $request){
        $chat_id=$request->id;
        Message::where('chat_id',$chat_id)->where('from_check','!=',Auth::user()->id.'-'.$this->u_type)->update(['status'=>'read']);
        return "success";
    }

    public function delete_chat(Request $request){
        $chat_id=$request->id;
        $data=Chat::select('id','is_del')->where('id',$chat_id)->first();
        if(strpos($data->is_del,'-')==false){
            $data->is_del=Auth::user()->id.'-'.$this->u_type;
        }
        else{
            $data->is_del="both";
        }
        $data->save();
        return "success";
    }

    public function fetch_all_contacts(Request $request){

        $self=Employee::where('id',Auth::user()->id)->first();
        if($self->profile_color==null){
            $self->profile_color=$this->colors[array_rand($this->colors)];
            $self->save();
        }

        $i=0;

        //Admin
        $admins=Admin::where('id',Auth::user()->admin_id)->get();
        foreach($admins as $admin){

            $chats=Chat::whereNotIn('is_del',$this->del_check)->where(function($query) use($admin){

                $query->where(function($q) use($admin){
                    $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type)->where('to_user_id',$admin->id)->where('to_user_type',"admin");
                })->orWhere(function($q) use($admin){
                    $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type)->where('from_user_id',$admin->id)->where('from_user_type',"admin");
                });

            })->first();

            if($chats){
                $chat_id=$chats->id;
            }
            else{
                $chat_id=0;
            }

            $admin_pro=admin_profile::where('admin_id',$admin->id)->first();
            if($admin_pro){
                if($admin_pro->profile_color==null){
                    $admin_pro->profile_color=$this->colors[array_rand($this->colors)];
                    $admin_pro->save();
                }
                if($admin_pro->profile_photo==null){
                    $profile='';
                }
                else{

                    $profile=$admin_pro->profile_photo;
                }
            }
            else{
                $admin_pro=new admin_profile();
                $admin_pro->admin_id=$admin->id;
                $admin_pro->profile_color=$this->colors[array_rand($this->colors)];
                $admin_pro->save();
                $profile='';
            }

            
            $check='online-'.$admin->id.'-'.$admin->email;

            if(Cache::has($check)){
                $status="online";
            }
            else{
                $status="offline";
            }

            $fl=substr($admin->name, 0,1);
            $fl=strtoupper($fl);
            $res[$i]["id"]=$admin->id;
            $res[$i]["chat_id"]=$chat_id;
            $res[$i]["color"]=$admin_pro->profile_color;
            $res[$i]["name"]=$admin->name;
            $res[$i]["fl"]=$fl;
            $res[$i]["status"]=$status;
            $res[$i]["type"]='admin';
            $res[$i]["profile_photo"]=$profile;
            $i++;
        }

        //Staff

        $employees=Employee::where('admin_id',Auth::user()->admin_id)->where('id','!=',Auth::user()->id)->where('login_email','!=',NULL)->where('login_email','!=','')->get();
        foreach($employees as $employee){
            $profile=$employee->profile_photo;
            if($profile==null)  $profile='';
            if($employee->profile_color==null){
                $employee->profile_color=$this->colors[array_rand($this->colors)];
                $employee->save();
            }

            $chats=Chat::whereNotIn('is_del',$this->del_check)->where(function($query) use($employee){

                $query->where(function($q) use($employee){
                    $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type)->where('to_user_id',$employee->id)->where('to_user_type',"provider");
                })->orWhere(function($q) use($employee){
                    $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type)->where('from_user_id',$employee->id)->where('from_user_type',"provider");
                });

            })->first();
            if($chats){
                $chat_id=$chats->id;
            }
            else{
                $chat_id=0;
            }

            $check='online-'.$employee->id.'-'.$employee->login_email;
            if(Cache::has($check)){
                $status="online";
            }
            else{
                $status="offline";
            }

            $fl=substr($employee->full_name, 0,1);
            $fl=strtoupper($fl);

            $res[$i]["id"]=$employee->id;
            $res[$i]["chat_id"]=$chat_id;
            $res[$i]["name"]=$employee->full_name;
            $res[$i]["fl"]=$fl;
            $res[$i]["color"]=$employee->profile_color;
            $res[$i]["status"]=$status;
            $res[$i]["profile_photo"]=$profile;
            $res[$i]["type"]="provider";
            $i++;
        }
        

        $client_ids=Appoinment::select('client_id')->where('provider_id',Auth::user()->id)->distinct()->get();
        $ids=[];
        foreach($client_ids as $client_idd){
            array_push($ids,$client_idd->client_id);
        }

        //Clients
        $clients=Client::whereIn('id',$ids)->where('login_email','!=',NULL)->where('login_email','!=','')->get();
        foreach($clients as $client){
            
            $profile=$client->profile_photo;
            if($profile==null)  $profile='';
            if($client->profile_color==null){
                $client->profile_color=$this->colors[array_rand($this->colors)];
                $client->save();
            }

            $chats=Chat::whereNotIn('is_del',$this->del_check)->where(function($query) use($client){

                $query->where(function($q) use($client){
                    $q->where('from_user_id',Auth::user()->id)->where('from_user_type',$this->u_type)->where('to_user_id',$client->id)->where('to_user_type',"patient");
                })->orWhere(function($q) use($client){
                    $q->where('to_user_id',Auth::user()->id)->where('to_user_type',$this->u_type)->where('from_user_id',$client->id)->where('from_user_type',"patient");
                });

            })->first();

            if($chats){
                $chat_id=$chats->id;
            }
            else{
                $chat_id=0;
            }

            $check='online-'.$client->id.'-'.$client->login_email;
            if(Cache::has($check)){
                $status="online";
            }
            else{
                $status="offline";
            }

            $fl=substr($client->client_full_name, 0,1);
            $fl=strtoupper($fl);

            $res[$i]["id"]=$client->id;
            $res[$i]["chat_id"]=$chat_id;
            $res[$i]["name"]=$client->client_full_name;
            $res[$i]["fl"]=$fl;
            $res[$i]["color"]=$client->profile_color;
            $res[$i]["status"]=$status;
            $res[$i]["profile_photo"]=$profile;
            $res[$i]["type"]="patient";
            $i++;
        }

        return json_encode($res);
    }

    public function fetch_all_patients(Request $request){

        $i=0;
        $res = [];
        $client_ids=Appoinment::select('client_id')->where('provider_id',Auth::user()->id)->distinct()->get();
        $ids=[];
        foreach($client_ids as $client_idd){
            array_push($ids,$client_idd->client_id);
        }

        //Clients
        $clients=Client::whereIn('id',$ids)->get();
        foreach($clients as $client){
            if($client->profile_color==null){
                $client->profile_color=$this->colors[array_rand($this->colors)];
                $client->save();
            }
            $color=$client->profile_color;
            $profile=$client->profile_photo;
            if($profile==null)  $profile='';

            $fl=substr($client->client_full_name, 0,1);
            $fl=strtoupper($fl);

            $res[$i]["id"]=$client->id;
            $res[$i]["name"]=$client->client_full_name;
            $res[$i]["fl"]=$fl;
            $res[$i]["color"]=$color;
            $res[$i]["profile_photo"]=$profile;
            $i++;
        }

        return json_encode($res);
    }

    public function download_file($name){
        return Response::download(public_path('assets/chat_files/' . $name));
    }

    public function generate_link(Request $request){
        $id=$request->client_id;
        $url=route('provider.client.info', $id);
        return response()->json([
            "status"=>"success",
            "url"=>$url
        ]);
    }

    public function chat_history($id){
        $from_check=Auth::user()->id.'-'.$this->u_type;
        if(strpos($id,'-')!=false){
            $to_check=$id;
            $arr=explode("-",$to_check);
            $to_id=$arr[0];
            $to_type=$arr[1];
            if($to_type=="admin"){
                $ad=Admin::select('id','name')->where('id',$to_id)->first();
                $name=$ad->name;
                $fl=substr($ad->name,0,1);
                $fl=strtoupper($fl);
                $user=admin_profile::select('profile_color','profile_photo')->where('admin_id',$ad->id)->first();
                $type="Admin";
            }
            else if($to_type=="provider"){
                $user=Employee::select('full_name','profile_color','profile_photo')->where('id',$to_id)->first();
                $type="Provider";
                $fl=substr($user->full_name,0,1);
                $fl=strtoupper($fl);
                $name=$user->full_name;
            }
            else if($to_type=="patient"){
                $user=Client::select('client_full_name','profile_color','profile_photo')->where('id',$to_id)->first();
                $type="Client";
                $fl=substr($user->client_full_name,0,1);
                $fl=strtoupper($fl);
                $name=$user->client_full_name;

            }
        }
        else{
            $to_check_q=Chat::select('to_user_id','to_user_type','from_user_id','from_user_type')->where('id',$id)->first();
            if($to_check_q->to_user_id==Auth::user()->id && $to_check_q->to_user_type==$this->u_type){
                $to_check=$to_check_q->from_user_id.'-'.$to_check_q->from_user_type;
                if($to_check_q->from_user_type=="admin"){
                    $ad=Admin::select('id','name')->where('id',$to_check_q->from_user_id)->first();
                    $name=$ad->name;
                    $fl=substr($ad->name,0,1);
                    $fl=strtoupper($fl);
                    $user=admin_profile::select('profile_color','profile_photo')->where('admin_id',$ad->id)->first();
                    $type="Admin";
                }
                else if($to_check_q->from_user_type=="provider"){
                    $user=Employee::select('full_name','profile_color','profile_photo')->where('id',$to_check_q->from_user_id)->first();
                    $type="Provider";
                    $fl=substr($user->full_name,0,1);
                    $fl=strtoupper($fl);
                    $name=$user->full_name;


                }
                else if($to_check_q->from_user_type=="patient"){
                    $user=Client::select('client_full_name','profile_color','profile_photo')->where('id',$to_check_q->from_user_id)->first();
                    $type="Client";
                    $fl=substr($user->client_full_name,0,1);
                    $fl=strtoupper($fl);
                    $name=$user->client_full_name;


                }
            }
            else{
                $to_check=$to_check_q->to_user_id.'-'.$to_check_q->to_user_type;
                if($to_check_q->to_user_type=="admin"){
                    $ad=Admin::select('id','name')->where('id',$to_check_q->to_user_id)->first();
                    $name=$ad->name;
                    $fl=substr($ad->name,0,1);
                    $fl=strtoupper($fl);
                    $user=admin_profile::select('profile_color','profile_photo')->where('admin_id',$ad->id)->first();
                    $type="Admin";
                }
                else if($to_check_q->to_user_type=="provider"){
                    $user=Employee::select('full_name','profile_color','profile_photo')->where('id',$to_check_q->to_user_id)->first();
                    $type="Provider";
                    $fl=substr($user->full_name,0,1);
                    $fl=strtoupper($fl);
                    $name=$user->full_name;

                }
                else if($to_check_q->to_user_type=="patient"){
                    $user=Client::select('client_full_name','profile_color','profile_photo')->where('id',$to_check_q->to_user_id)->first();
                    $type="Client";
                    $fl=substr($user->client_full_name,0,1);
                    $fl=strtoupper($fl);
                    $name=$user->client_full_name;

                }
            }
        }

        $data=msg_attachment::where(function($q) use($from_check,$to_check){
            $q->where('from_check',$from_check)->where('to_check',$to_check);
        })->orWhere(function($q) use($from_check,$to_check){
            $q->where('from_check',$to_check)->where('to_check',$from_check);
        })->orderBy('created_at','desc')->paginate(20);
        return view('provider.chat.chatHistory',compact('data','user','fl','name'));

    }

    public function upload_file(Request $request){
        if ($request->hasFile('file')) {
            $file_ins = $request->file('file');
            $originalName = $file_ins->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $name=$filename.'_'.time().'.'.$extension;
            $uploadPath = 'assets/chat_files/';
            $file_ins->move($uploadPath, $name);
            return $name;
        }
    }

    public function delete_msg(Request $request){
        $id=$request->msg_id;
        $msg=Message::select('id','is_del','del_at','from_check')->where('id',$id)->first();
        if($msg->from_check==Auth::user()->id.'-'.$this->u_type){
            $msg->is_del="both";
        }
        else{
            $msg->is_del=Auth::user()->id.'-'.$this->u_type;
        }
        $msg->del_at=Carbon::now('UTC');
        $msg->save();

        return "success";
    }

}
