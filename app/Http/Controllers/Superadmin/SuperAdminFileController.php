<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\sftp_file_manage;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class SuperAdminFileController extends Controller
{

    protected $admin_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->is_up_admin==1){
                $this->admin_id=Auth::user()->id;
            }
            else{
                $this->admin_id=Auth::user()->up_admin_id;
            }
            return $next($request);
        });
    }

    public function file_manager()
    {
        return view('superadmin.settingFileManager.fileManager');
    }

    public function era_list(){
        $data=sftp_file_manage::where('admin_id',$this->admin_id)->where('file_name','like','%ERA_STATUS%')->orderBy('receive_date','DESC')->paginate(10);
        return response()->json([
            "data"=>$data,
            "view"=>\View::make('superadmin.settingFileManager.include.eraHtml',compact('data'))->render(),
        ]);
    }

    public function edi_list(){
        $data=sftp_file_manage::where('admin_id',$this->admin_id)->where('file_name','like','%EDI_STATUS%')->orderBy('receive_date','DESC')->paginate(10);
        return response()->json([
            "data"=>$data,
            "view"=>\View::make('superadmin.settingFileManager.include.ediHtml',compact('data'))->render(),
        ]);
    }

    public function open_sftp_txt($user,$name){
        
        $path=Storage::disk('custom')->path('/'.$user.'/'.$name);
        
        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'inline; filename="'.$name.'"'
        ]);

    }

    public function open_sftp_file(Request $request){
        $path=$request->zip_name;
        $name=explode('/',$path);
        $name=$name[2];
        if(Storage::disk('custom')->exists($path)){
            $path=Storage::disk('custom')->path($path);
            if(isset($request->pass_check)){
                $pass=$request->password;
                if($pass!=null && $pass!=''){
                    $zip = new ZipArchive();
                    $res=$zip->open($path, ZipArchive::CREATE);
                    if($res==true){
                        $zip->setPassword($pass); 
                        // $zip->setEncryptionName($name, ZipArchive::EM_AES_256, $pass); 
                        $zip->close();
                    }
                    //Storage::disk('custom')->put($name,$zip);
                }
            }
        }
        else{
            return back()->with('alert','File not found.');
        }

        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="'.$name.'"'
        ]);
    }
}
