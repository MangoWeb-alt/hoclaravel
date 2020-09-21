<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Brand;
use App\Category;
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
            return redirect::to('add-post')->with('message','add post successfully');
        } else {
            Session::put('message','Please add image');
            return redirect::to('add-post');
        }
    }
    public function active_post($posts_id)
    {
        $post = Post::where('posts_id',$posts_id)->first();
        $post->update(['posts_status'=>'2']);
        return redirect()->back()->with('message','change status successfully');
    }
    public function non_active_post($posts_id)
    {
        $post = Post::where('posts_id',$posts_id)->first();
        $post->update(['posts_status'=>'1']);
        return redirect()->back()->with('message','change status successfully');
    }
    public function delete_posts($posts_id)
    {
        $this->Auth_login();
        $post = Post::where('posts_id',$posts_id)->first();
        $post->delete();
        $post_image_old = $post->posts_image;
        $path = 'style/uploads/post/'.$post_image_old;
        unlink($path);
        return Redirect::to('/post-list')->with('message','delete post successfully');
    }
    public function posts_list()
    {
        $this->Auth_login();
        $post = Post::join('tbl_category_post','tbl_category_post.post_category_id','=','tbl_posts.post_category_id')->orderBy('posts_id','DESC')->get();
        return view('admin.PostDetails.all_post')->with('post',$post);
    }
    public function edit_post($posts_id)
    {
        $post = Post::join('tbl_category_post','tbl_category_post.post_category_id','=','tbl_posts.post_category_id')->where('posts_id',$posts_id)->get();
        $categoryPost = CategoryPost::orderby('post_category_id','DESC')->get();
        return view('admin.PostDetails.edit_post')->with('post',$post)->with('categoryPost',$categoryPost);
    }
    public function update_post(Request $request,$posts_id)
    {
            $data = $request->all();
            $post = Post::find($posts_id);

            $post->posts_name = $data['posts_name'];
            $post->posts_description = $data['posts_description'];
            $post->posts_content = $data['posts_content'];
            $post->posts_meta_keywords = $data['posts_meta_keywords'];
            $post->posts_slug = $data['posts_slug'];
            $post->post_category_id = $data['post_category_id'];

            $get_image =$request->file('posts_image');
            if($get_image){
                $post_image_old = $post->posts_image;
                $path = 'style/uploads/post/'.$post_image_old;
                unlink($path);
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image ->move('style/uploads/post',$new_image);
                $post->posts_image =  $new_image;
            }
        $post->save();
        return redirect()->back()->with('message','Update post successfully');
    }
    public function show_post_details(Request $request,$posts_slug)
    {
        $meta_description ='' ;
        $meta_keywords = '';
        $meta_title = '' ;
        $url_canonical = $request->url();

        $category_post = CategoryPost::orderby('post_category_id','DESC')->where('post_category_status','2')->get();
        $slider = Banner::orderby('slider_id','DESC')->get();
        $category_product = Category::orderby('category_id','desc')->where('category_status','2')->get();
        $brand_product = Brand::orderby('brand_id','desc')->get();
        $post = Post::where('posts_status','2')->where('posts_slug',$posts_slug)->orderby('posts_id','DESC')->paginate(5);
        foreach ($post as $key => $value){
            $post_category_id = $value->post_category_id;
            $meta_description = $value->posts_description;
            $meta_keywords = $value->posts_meta_keywords;
            $meta_title = $value->posts_name ;
            $url_canonical = $request->url();
        }
        $related = Post::where('posts_status','2')->orderby('posts_id','DESC')->where('post_category_id',$post_category_id)
            ->WhereNotIn('posts_slug',[$posts_slug])->take(5)->get();
        return view ('Home.post.post_details')->with('post',$post)->with('category_product',$category_product)->with('brand_product',$brand_product)
            ->with('meta_description',$meta_description)->with('meta_keywords',$meta_keywords)
            ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)
            ->with('related',$related);
    }
}
