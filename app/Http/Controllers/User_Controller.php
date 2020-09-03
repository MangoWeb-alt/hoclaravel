<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class User_Controller extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with('admin',$admin);
    }
    public function Add_Users()
    {

    }
}
