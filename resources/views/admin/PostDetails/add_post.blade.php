@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session; ?>
    <section class="panel">
        <header class="panel-heading">
            Post
        </header>
        <?php
        $message = session::get('message');
        if($message){
            echo '<p style="color: red;font-size:35px;font-weight: 400">'.$message.'</p>';
            Session::put('message',NULL);
        }
        ?>
        <div class="position-center">
            <form action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">PostName</label>
                    <input type="text" name="posts_name" data-validation="length" data-validation-length="min3" class="form-control" required="" id="exampleInputEmail1" placeholder="Enter brand Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">PostCategoryName</label>
                </div>
                <select name="posts_category_id" class="form-control input-sm m-bot15">
                    @foreach($categoryPost as $key=>$category)
                        <option value="{{$category->post_category_id}}">{{$category->post_category_name}}</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="exampleInputEmail1">PostSlug</label>
                    <input type="text" name="posts_slug" data-validation="length" data-validation-length="min3" class="form-control" required="" id="exampleInputEmail1" placeholder="Enter brand Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">PostImage</label>
                    <input type="file" name="posts_image"  class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostDescription</label>
                    <textarea name="posts_description" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor1"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostContent</label>
                    <textarea name="posts_content" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keywords</label>
                    <textarea name="posts_meta_keywords" data-validation="length" data-validation-length="min3" rows="8" class="form-control" required="" id="ckEditor3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                </div>
                <select name="posts_status" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="save_posts" value="Save" class="btn btn-info">
            </form>
        </div>
    </section>










@endsection
