<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Roles;
use Illuminate\Support\Facades\Redirect;

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
    public function store_users(Request $request)
    {
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password =md5($data['admin_name']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        return Redirect::to('users')->with('message',"Add users successfully");

    }
    public function assign_roles(Request $request){
        $data = $request->all();
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
}
