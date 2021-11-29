<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
  
class AdminProfileController extends Controller
{
    //

    public function AdminProfile()
    {
        // get admin related data
        $adminData=Admin::find(1); 
        return view('admin.admin_profile_view',compact('adminData'));       
    }

    public function AdminProfileEdit()
    {
        // get admin related data
        $editData=Admin::find(1); 
        return view('admin.admin_profile_edit',compact('editData'));       
    }

    public function AdminProfileUpdate(Request $request)
    {
        // get admin related data
        $data=Admin::find(1); 
        $data->name=$request->name;
        $data->email=$request->email;
        if($request->file('profile_photo_path'))
        {
            $file=$request->file('profile_photo_path');

            if($data->profile_photo_path)
            {
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path)); 
            }
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path']=$filename;

        }
        $data->save();

        $notification=array('message'=>"Admin Profile  Updated",'alert-type'=>'success');

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdateChangePassword(Request $request)
    {
        
        $validateData=$request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required|confirmed',
        ],
        [   
            'oldpassword.required'=>'Required Old Password',
            'newpassword.required'=>'Required New Password ',
        ]);

        $hasedPassword=Admin::find(1)->password; // existing password
        if(Hash::check($request->oldpassword,$hasedPassword))
        {
            
            $adminData=Admin::find(1);
            $adminData->password=Hash::make($request->newpassword);
            $adminData->save();
            Auth::logout();
            return redirect()->route('admin.logout');

        } else
        {
            //echo "Not Matched";
            //die;
            return redirect()->back();
        
        }


    }



}
