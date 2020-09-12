@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session; ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Post
            </div>
            <?php
            $message = Session::get('message');
            if($message){
                echo '<p style="color: green;font-size: 35px;font-weight: 400;text-align: center">'.$message.'</p>';
            }
            ?>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                            </label>
                        </th>
                        <th>PostName</th>
                        <th>PostCategoryName</th>
                        <th>PostSlug</th>
                        <th>PostImage</th>
                        <th>PostDescription</th>
                        <th>PostContent</th>
                        <th>PostKeywords</th>
                        <th>PostStatus</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $key=>$post_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$post_pro->posts_name}}</td>
                            <td>{{$post_pro->post_category_name}}</td>
                            <td>{{$post_pro->posts_slug}}</td>
                            <td><img src="{{('style/uploads/post/'.$post_pro->posts_image)}}" width="120" height="100"></td>
                            <td>{!!$post_pro->posts_description !!}</td>
                            <td>{!!$post_pro->posts_meta_keywords!!}</td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($post_pro->posts_status == 1){
                                    ?>
                              <a href="{{URL::to('active-post/'.$post_pro->posts_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('non-active-post/'.$post_pro->posts_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('edit-post/'.$post_pro->posts_id)}}"   class="active"  style="font-size:15px;color:blue">Edit</a>
                                <a href="{{URL::to('delete-post/'.$post_pro->posts_id)}}" class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

