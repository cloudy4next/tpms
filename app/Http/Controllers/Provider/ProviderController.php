<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\provider_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class ProviderController extends Controller
{
    public function index()
    {
        $providers = Employee::where('id', Auth::user()->id)->first();
        return view('provider.index', compact('providers'));
    }


    public function profile(){
        $data=provider_profile::where('provider_id',Auth::user()->id)->first();
        if($data){
            return view('provider.profile',compact('data'));
        }
        else{
            $data=new provider_profile();
            $data->provider_id=Auth::user()->id;
            $data->user_name=null;
            $data->marital=null;
            $data->age=null;
            $data->city=null;
            $data->country=null;
            $data->state=null;
            $data->address=null;
            $data->profile_photo=null;
            $data->save();
            $data=provider_profile::where('provider_id',Auth::user()->id)->first();
            return view('provider.profile',compact('data'));
        }
    }

    public function personal_update(Request $request){
        $data=provider_profile::where('provider_id',Auth::user()->id)->first();
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

        $data->user_name=$request->user_name;
        $data->city=$request->city;
        $data->marital=isset($request->marital)? $request->marital : null;
        $data->age=$request->age;
        $data->country=isset($request->country)? $request->country: null;
        $data->state=isset($request->state)? $request->state: null;
        $data->address=$request->address;
        $data->save();


        $data=Employee::where('id',Auth::user()->id)->first();
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        $data->gender=$request->gender;
        $data->staff_birthday=$request->dob;
        $data->save();
        return back()->with('success','Profile updated successfully!');
    }

    public function email_update(Request $request){
        $data=Employee::where('id',Auth::user()->id)->first();
        $data->email_not=$request->email_not;
        $data->sms_not=$request->sms_not;
        $data->save();

        return back()->with('success','Profile updated successfully!');

    }

    public function contact_update(Request $request){
        $data=Employee::where('id',Auth::user()->id)->first();
        $check=Hash::check($request->current_pass, $data->password);
        if(!$check){
            return back()->with('alert','Current password is wrong.');
        }
        $data->phone=$request->phone;
        $data->login_email=$request->email;
        $data->url=$request->url;
        $data->save();

        return back()->with('success','Profile updated successfully!');

    }

    public function verify_password(Request $request){
        $data=Employee::where('id',Auth::user()->id)->first();
        $check=Hash::check($request->current_pass, $data->password);
        if(!$check){
            return "wrong";
        }
        else{
            return "correct";
        }
    }

    public function password_update(Request $request){
        $data=Employee::where('id',Auth::user()->id)->first();
        $data->password = Hash::make($request->verify_pass);
        $data->save();

        return back()->with('success','Password updated successfully!');
    }

    public function account_chnage_password()
    {
        $flag["pass"]="password";
        $data=provider_profile::where('provider_id',Auth::user()->id)->first();
        if($data){
            return view('provider.profile',compact('data','flag'));
        }
        else{
            $data=new provider_profile();
            $data->provider_id=Auth::user()->id;
            $data->user_name=null;
            $data->marital=null;
            $data->age=null;
            $data->city=null;
            $data->country=null;
            $data->state=null;
            $data->address=null;
            $data->profile_photo=null;
            $data->save();
            $data=provider_profile::where('provider_id',Auth::user()->id)->first();
            return view('provider.profile',compact('data','flag'));
        }
    }

}
