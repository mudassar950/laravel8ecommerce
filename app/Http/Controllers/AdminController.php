<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function AdminDashboard() {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }
    
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo'))
        {
            $file = $request->file('photo');
            unlink(public_path('uploads/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_changePassword', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        // check old password

        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            $notification = array(
                'message' => 'Old password does not matched!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // Change password

        if($request->new_password === $request->password_confirmation){
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Admin password has been changed successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    else
        $notification = array(
            'message' => 'New Password does not matched with Confirmed password!',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

}
