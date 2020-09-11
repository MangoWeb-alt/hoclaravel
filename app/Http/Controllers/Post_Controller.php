<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Post;
session_start();

class Post_Controller extends Controller
{
    public function Auth_login()
    {
        $admin_id = Auth::id('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        } else {
            return redirect::to('login-auth')->send();
        }
    }
    public function add_post()
    {
        $this->auth_login();
        return view ('admin.Post.add_post');
    }
    public function save_post(Request $request)
    {
        $this->auth_login();
        $data = $request->all();
        $post = new Post();
        $post->post_name = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_description = $data['post_description'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_status = $data['post_status'];

        $post->save();
        return Redirect()->back()->with('message','Add post successfully');
    }
    public function all_post()
    {
        $this->auth_login();
        $post = Post::orderBy('post_id','DESC')->get();
        return view ('admin.Post.post_list')->with('post',$post);
    }
    public function non_active_post($post_id)
    {
        $this->auth_login();
        Post::where('post_id',$post_id)->update(['post_status'=>'1']);
        Session::put('message','Turn off Post');
        return Redirect()->back()->with('message','Change post status successfully');
    }
    public function active_post($post_id)
    {
        $this->auth_login();
        Post::where('post_id',$post_id)->update(['post_status'=>'2']);
        Session::put('message','Turn on post');
        return Redirect()->back()->with('message','Change post status successfully');
    }
    public function post_details($post_slug)
    {
        $this->Auth_login();
    }
}
