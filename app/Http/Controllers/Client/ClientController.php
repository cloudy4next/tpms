<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function profile(){
        return view('client.profile');
    }

    public function personal_update(Request $request){
        $data=Client::where('id',Auth::user()->id)->first();
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

        $data->client_first_name=$request->first_name;
        $data->client_last_name=$request->last_name;
        $data->client_u_name=$request->user_name;
        $data->client_city=$request->city;
        $data->client_gender=$request->gender;
        $data->client_dob=$request->dob;
        $data->client_marital=isset($request->marital)? $request->marital : null;
        $data->client_age=$request->age;
        $data->client_country=isset($request->country)? $request->country: null;
        $data->client_state=isset($request->state)? $request->state: null;
        $data->client_address=$request->address;

        $data->save();
        return back()->with('success','Profile updated successfully!');
    }

    public function email_update(Request $request){
        $data=Client::where('id',Auth::user()->id)->first();
        $data->email_not=$request->email_not;
        $data->sms_not=$request->sms_not;
        $data->save();

        return back()->with('success','Profile updated successfully!');

    }

    public function contact_update(Request $request){
        $data=Client::where('id',Auth::user()->id)->first();
        $data->phone_number=$request->phone;
        $data->login_email=$request->email;
        $data->url=$request->url;
        $data->save();

        return back()->with('success','Profile updated successfully!');

    }

    public function verify_password(Request $request){
        $data=Client::where('id',Auth::user()->id)->first();
        $check=Hash::check($request->current_pass, $data->password);
        if(!$check){
            return "wrong";
        }
        else{
            return "correct";
        }
    }

    public function password_update(Request $request){
        $data=Client::where('id',Auth::user()->id)->first();
        $data->password = Hash::make($request->verify_pass);
        $data->save();

        return back()->with('success','Password updated successfully!');
    }

    public function account_chnage_password()
    {
        $flag["pass"]="password";
        return view('client.profile',compact('flag'));
    }


}
