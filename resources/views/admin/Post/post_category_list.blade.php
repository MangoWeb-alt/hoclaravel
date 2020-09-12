@extends('admin_layout')
@section('content')
    <?php use Illuminate\Support\Facades\Session; ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <?php
            $message = Session::get('message');
            if($message){
                echo '<p style="color: green;font-size: 35px;font-weight: 400;text-align: center">'.$message.'</p>';
            }
            ?>
            <div class="panel-heading">
                All Post
            </div>

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
                        <th>PostSlug</th>
                        <th>PostDescription</th>
                        <th>PostKeywords</th>
                        <th>PostStatus</th>
                        <th style="width:30px; "></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $key=>$post_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$post_pro->post_category_name}}</td>
                            <td>{{$post_pro->post_category_slug}}</td>
                            <td>{!!$post_pro->post_category_description!!}</td>
                            <td>{!!$post_pro->post_category_meta_keywords!!}</td>
                            <td><span class="text-ellipsis">
                           <?php
                                    if($post_pro->post_category_status == 1){
                                    ?>
                              <a href="{{URL::to('active-category-post/'.$post_pro->post_category_id)}}" style="font-size: 30px;color:red">Off</a>
                           <?php
                                    } else {
                                    ?>
                               <a href="{{URL::to('non-active-category-post/'.$post_pro->post_category_id)}}" style="font-size: 30px;color:blue;">Onl</a>
                               <?php
                                    }
                                    ?>
                            </span></td>
                            <td>
                                <a href="{{URL::to('edit-category-post/'.$post_pro->post_category_id)}}"   class="active"  style="font-size:15px;color:blue">Edit</a>
                                <a href="{{URL::to('delete-category-post/'.$post_pro->post_category_id)}}" class="active"  style="font-size: 15px;color:red" onclick="return confirm('Are you want to delete?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--                <form action="{{url('/import-csv')}}" method="POST" enctype="multipart/form-data">--}}
                {{--                    @csrf--}}
                {{--                    <input type="file" name="file" accept=".xlsx .ods" >--}}
                {{--                    <input type="submit" value="Import file excel" name="import_csv" class="btn btn-warning">--}}
                {{--                </form>--}}
                {{--                <form action="{{url('/export-csv')}}" method="POST">--}}
                {{--                    @csrf--}}
                {{--                    <input type="submit" value="Export file excel" name="export_csv" class="btn btn-success">--}}
                {{--                </form>--}}
            </div>
        </div>
    </div>
@endsection

