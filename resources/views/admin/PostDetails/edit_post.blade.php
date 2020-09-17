@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session; ?>
    <section class="panel">
        <header class="panel-heading">
            Edit Post
        </header>
        @foreach($post as $key => $value_post)
        <div class="position-center">
            <?php
            $message = session::get('message');
            if($message){
                echo '<p style="color: red;font-size:35px;font-weight: 400">'.$message.'</p>';
                Session::put('message',NULL);
            }
            ?>
            <form action="{{URL::to('/update-post/'.$value_post->posts_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">PostName</label>
                    <input type="text" name="posts_name" data-validation="length" value="{{$value_post->posts_name}}" data-validation-length="min3" class="form-control" required="" id="exampleInputEmail1" placeholder="Enter Post Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">PostCategoryName</label>
                </div>
                <select name="post_category_id" class="form-control input-sm m-bot15">
                        <option selected="selected" value="{{$value_post->post_category_id}}">{{$value_post->post_category_name}}</option>
                    @foreach($categoryPost as $key=>$category)
                        @if($value_post->post_category_id != $category->post_category_id)
                        <option value="{{$category->post_category_id}}">{{$category->post_category_name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="exampleInputEmail1">PostSlug</label>
                    <input type="text" name="posts_slug" data-validation="length" value="{{$value_post->posts_slug}}" data-validation-length="min3" class="form-control" required="" id="exampleInputEmail1" placeholder="Enter brand Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">PostImage</label>
                    <img src="{{url('style/uploads/post/'.$value_post->posts_image)}}" />
                    <input type="file" name="posts_image" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostDescription</label>
                    <textarea name="posts_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor1">{!!$value_post->posts_description!!}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostContent</label>
                    <textarea name="posts_content" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor2">{!!$value_post->posts_content!!}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="posts_meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor3">{!!$value_post->posts_meta_keywords!!}</textarea>
                </div>
                <input type="submit" name="update_posts" value="Update" class="btn btn-info">
            </form>
        </div>
            @endforeach
    </section>
@endsection
