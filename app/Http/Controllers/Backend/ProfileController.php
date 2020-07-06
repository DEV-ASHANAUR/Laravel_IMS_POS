<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    //view profile method
    public function view()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.view-profile',compact('user')); 
    }
    //edit profile method
    public function edit()
    {
        $id = Auth::user()->id;
        $editdata = User::find($id);
        return view('backend.user.edit-profile',compact('editdata'));
    }
    // update profile method
    public function update(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->moblie;
        $data->address = $request->address;
        $data->dob = $request->dob;
        $data->about = $request->about;
        if($request->file('file')){
            $file = $request->file('file');
            @unlink(public_path('upload/users_images/'.$data->image));
            $filename = date("YmdHi").$file->getClientOriginalName();
            $file->move(public_path('upload/users_images'),$filename);
            $data['image'] = $filename;

        }
        $update = $data->save();
        if($update){
            $notification=array(
                'message'=>'Successfully Updated',
                'alert-type'=>'success'
            );
            return redirect()->route('profile.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('profile.view')->with($notification);
        }
    }
    //password_view method
    public function passview()
    {
        return view('backend.user.edit-password');
    }
    //password change method
    public function passchange(Request $request)
    {
        if(Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->cur_password])){
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $update = $user->save();
            if($update){
                $notification=array(
                    'message'=>'Successfully Change Your Password',
                    'alert-type'=>'success'
                );
                return redirect()->route('profile.view')->with($notification);
            }else{
                $notification=array(
                    'message'=>'Something went worng!',
                    'alert-type'=>'error'
                );
                //return Redirect()->back()->with($notification);
                return redirect()->route('profile.view')->with($notification);
            }
        }else{
            $notification=array(
                'message'=>'Your Current Password is worng!',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        
    }
}
