<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class User_Controller extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with('admin',$admin);
    }
    public function Add_Users()
    {
        return view ('admin.users.add_users');
    }
    public function store_role(Request $request)
    {
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_name']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        return Redirect::to('/all_users')->with('message',"Add users successfully");
    }
    public function impersonate_destroy()
    {
        session()->forget('impersonate');
        return redirect::to('/dashboard');
    }
    public function impersonate($admin_id)
    {
        $user = Admin::where('admin_id',$admin_id)->first();
        if($user){
            session()->put('impersonate',$user->admin_id);
        }
        return redirect::to('/dashboard');
    }
    public function delete_user_roles($admin_id)
    {
        if(Auth::id() == $admin_id){
            return Redirect::to('/all_users')->with('message','cannot delete yourself');
        }

        $admin = Admin::find($admin_id);

        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','delete successfully');
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        if(Auth::id() == $data['admin_id']){
            return Redirect::to('/all_users')->with('message','Cannot assign yourself');
        }
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['user_role']){
            $user->roles()->attach(Roles::where('name','user')->first());
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name','admin')->first());
        }
        return redirect()->back();
    }
    public function store_roles(Request $request)
    {

    }
}
