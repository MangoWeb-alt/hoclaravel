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
            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
            Session::put('message',NULL);
        }
        ?>
        <div class="position-center">
            <form action="{{URL::to('/save-category-post')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">PostName</label>
                    <input type="text" name="post_category_name" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name:">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">PostSlug</label>
                    <input type="text" name="post_category_slug" data-validation="length" required="" data-validation-length="min3" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Slug:">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostDescription</label>
                    <textarea name="post_category_description" rows="8" data-validation="length" required="" data-validation-length="min3" class="form-control" id="ckEditor"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">PostKeywords</label>
                    <textarea name="post_category_meta_keywords" rows="8" data-validation="length" required="" data-validation-length="min3" class="form-control" id="ckEditor8"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">PostStatus</label>
                </div>
                <select name="post_category_status" class="form-control input-sm m-bot15">
                    <option value="1">Off</option>
                    <option value="2">Onl</option>
                </select>
                <input type="submit" name="save_post" value="Save" class="btn btn-info">
            </form>
        </div>
    </section>

@endsection
