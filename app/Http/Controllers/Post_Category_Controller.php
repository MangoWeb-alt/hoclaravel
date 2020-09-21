<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Brand;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\CategoryPost;
session_start();

class Post_Category_Controller extends Controller
{
    public function Auth_login()
    {
        $admin_id = Auth::id('admin_id');
        if($admin_id){
            return redirect::to('/dashboard');
        } else {
            return redirect::to('/login-auth')->send();
        }
    }
    public function add_category_post()
    {
        $this->Auth_login();
        return view ('admin.Post.add_category_post');
    }
    public function save_category_post(Request $request)
    {
        $this->Auth_login();
        $data = $request->all();
        $post = new CategoryPost();
        $post->post_category_name = $data['post_category_name'];
        $post->post_category_slug = $data['post_category_slug'];
        $post->post_category_description = $data['post_category_description'];
        $post->post_category_meta_keywords = $data['post_category_meta_keywords'];
        $post->post_category_status = $data['post_category_status'];

        $post->save();
        return Redirect()->back()->with('message','Add post successfully');
    }
    public function all_category_post()
    {
        $this->Auth_login();
        $post = CategoryPost::orderBy('post_category_id','DESC')->get();
        return view ('admin.Post.post_category_list')->with('post',$post);
    }
    public function non_active_category_post($post_category_id)
    {
        $this->Auth_login();
        CategoryPost::where('post_category_id',$post_category_id)->update(['post_category_status'=>'1']);
        Session::put('message','Turn off CategoryPost');
        return Redirect()->back()->with('message','Change post status successfully');
    }
    public function active_category_post($post_category_id)
    {
        $this->Auth_login();
        CategoryPost::where('post_category_id',$post_category_id)->update(['post_category_status'=>'2']);
        Session::put('message','Turn on post');
        return Redirect()->back()->with('message','Change post status successfully');
    }
    public function edit_category_post($post_category_id)
    {
        $this->Auth_login();
        $post = CategoryPost::Where('post_category_id',$post_category_id)->get();
        return view('admin.Post.edit_category_post')->with('post',$post);
    }
    public function update_category_post(Request $request,$post_category_id)
    {
        $this->Auth_login();
        $data = array();
        $data['post_category_name'] = $request->post_category_name;
        $data['post_category_meta_keywords']=$request->post_category_meta_keywords;
        $data['post_category_description'] = $request->post_category_description;
        $data['post_category_slug'] = $request->post_category_slug;
        CategoryPost::where('post_category_id',$post_category_id)->update($data);
        return redirect()->back()->with('message','Update CategoryPost successfully');
    }
    public function delete_category_post($post_category_id)
    {
        $this->Auth_login();
        CategoryPost::Where('post_category_id',$post_category_id)->delete();
        return Redirect()->back()->with('message','Delete post successfully');
    }
    public function post_category_details(Request $request,$post_category_id)
    {
        $meta_description ='' ;
        $meta_keywords = '';
        $meta_title = '' ;
        $url_canonical = $request->url();

        $category_post = CategoryPost::orderby('post_category_id','DESC')->where('post_category_status','2')->get();
        $slider = Banner::orderby('slider_id','DESC')->get();
        $category_product = Category::orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = Brand::orderby('brand_id','desc')->get();

        $post = Post::where('posts_status','2')->where('post_category_id',$post_category_id)->orderby('posts_id','DESC')->get();
        foreach($post as $key => $value){
            $meta_description = $value->posts_description ;
            $meta_keywords =$value->posts_meta_keywords ;
            $meta_title =$value->posts_name ;
            $url_canonical = $request->url();
        }

        return view ('Home.post.post_category')->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('post',$post);
    }
}
