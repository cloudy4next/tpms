<?php

namespace App\Http\Controllers\Mainadmin;

use App\Http\Controllers\Controller;
use App\Models\BillerlogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainAdminBillerLogUserController extends Controller
{
    public function billerlog_user()
    {
        $all_users = BillerlogUser::orderBy('id', 'desc')->paginate(15);
        return view('mainadmin.billerlog.userList', compact('all_users'));
    }

    public function billerlog_user_save(Request $request)
    {
        $new_user = new BillerlogUser();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->save();
        return back()->with('success', 'Billerlog User Successfully Created');
    }

    public function billerlog_user_update(Request $request)
    {
        $new_user = BillerlogUser::where('id', $request->user_edit_biller)->first();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        if ($request->password != null || $request->password != '') {
            $new_user->password = Hash::make($request->password);
        }
        $new_user->save();
        return back()->with('success', 'Billerlog User Successfully Updated');
    }

    public function billerlog_user_delete(Request $request)
    {
        $new_user = BillerlogUser::where('id', $request->user_del_biller)->first();
        if ($new_user) {
            $new_user->delete();
            return back()->with('success', 'Billerlog User Successfully Updated');
        } else {
            return back()->with('alert', 'Billerlog User Not Found');
        }
    }
}
