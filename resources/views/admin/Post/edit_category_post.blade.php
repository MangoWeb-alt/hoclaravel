@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session; ?>
    <section class="panel">
        <header class="panel-heading">
            Post
        </header>
        <?php
        $message = Session::get('message');
        if($message){
            echo '<p style="color: green;font-size: 35px;font-weight: 400;text-align: center">'.$message.'</p>';
        }
        ?>
        <div class="position-center">
            @foreach($post as $key=>$value_post)
                <form action="{{URL::to('/update-category-post/'.$value_post->post_category_id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">PostName</label>
                        <input type="text" name="post_category_name" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_post->post_category_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PostSlug</label>
                        <input type="text" name="post_category_slug" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" value="{{$value_post->post_category_slug}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="post_category_description" data-validation="length" required="" data-validation-length="min3" rows="8" class="form-control" id="ckEditor5">{{$value_post->post_category_description}}</textarea>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keywords</label>
                        <textarea name="post_category_meta_keywords" data-validation="length" required="" data-validation-length="min3" rows="8" class="form-control" id="ckEditor9">{{$value_post->post_category_meta_keywords}}</textarea>
                    </div>
                    <input type="submit" name="update_post" value="Update" class="btn btn-info">
                </form>
            @endforeach
        </div>
    </section>
@endsection
