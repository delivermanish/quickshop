<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //

    public function index()
    {
        return view('frontend.index');
    }


    public function userProfile()
    {
        $id=Auth::user()->id;
        $userData=User::find($id);
        return view('frontend.profile.user_profile',compact('userData'));
    }


    public function userLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function userProfileUpdate(Request $request)
    {
         // get User related data
         $data=User::find(Auth::user()->id); 
         $data->name=$request->name;
         $data->email=$request->email;
         $data->phone=$request->phone;

         if($request->file('profile_photo_path'))
         {
             $file=$request->file('profile_photo_path');
 
             if($data->profile_photo_path)
             {
             unlink(public_path('upload/user_images/'.$data->profile_photo_path)); 
             }
             $filename=date('YmdHi').$file->getClientOriginalName();
             $file->move(public_path('upload/user_images'),$filename);
             $data['profile_photo_path']=$filename;
 
         }
         $data->save();
 
         $notification=array('message'=>"User Profile  Updated",'alert-type'=>'success');
 
         return redirect()->route('dashboard')->with($notification);
    } // end method

    public function userChangePassword()
    {
        $id=Auth::user()->id;
        $userData=User::find($id);
        return view('frontend.profile.change_password',compact('userData'));
    }

    public function userUpdateChangePassword(Request $request)
    {
        $validateData=$request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ],
        [   
            'oldpassword.required'=>'Required Old Password',
            'password.required'=>'Required New Password ',
        ]);

        $hasedPassword=User::find(1)->password; // Get existing password
        if(Hash::check($request->oldpassword,$hasedPassword))
        {
            
            $userData=User::find(Auth::user()->id);
            $userData->password=Hash::make($request->password);
            $userData->save();
            Auth::logout();
            return redirect()->route('user.logout');

        } else
        {
            //echo "Not Matched";
            //die;
            return redirect()->back();
        
        }

    }

}
