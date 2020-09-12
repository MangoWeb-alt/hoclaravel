<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        $this->Auth_login();
        $categoryPost = CategoryPost::orderBy('post_category_id','DESC')->get();
        return view('admin.PostDetails.add_post')->with('categoryPost',$categoryPost);
    }
    public function save_post(Request $request)
    {
        $this->Auth_login();
        $data = $request->all();
        $post = new Post();
        $post->posts_name = $data['posts_name'];
        $post->post_category_id = $data['posts_category_id'];
        $post->posts_description = $data['posts_description'];
        $post->posts_slug = $data['posts_slug'];
        $post->posts_content = $data['posts_content'];
        $post->posts_meta_keywords = $data['posts_meta_keywords'];
        $post->posts_status = $data['posts_status'];


        $get_image =$request->file('posts_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('style/uploads/post',$new_image);
            $post->posts_image =  $new_image;
            $post->save();
            return redirect::to('post-list')->with('message','add post successfully');
        } else {
            Session::put('message','Please add image');
            return redirect::to('post-list');
        }
    }
    public function active_post($posts_id)
    {

    }
    public function non_active_post($posts_id)
    {

    }
    public function delete_posts($posts_id)
    {
        $this->Auth_login();
        $post = Post::where('posts_id',$posts_id)->first();
        $post->delete();
        unlink('style/uploads/post/'.$post->posts_image);
        return Redirect::to('/post-list')->with('message','delete post successfully');
    }
    public function posts_list()
    {
        $this->Auth_login();
        $post = Post::join('tbl_category_post','tbl_category_post.post_category_id','=','tbl_posts.post_category_id')->orderBy('posts_id','DESC')->get();
        return view('admin.PostDetails.all_post')->with('post',$post);
    }

}
