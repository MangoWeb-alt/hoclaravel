@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm user
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert" style="color: red; font-size: 40px; font-weight: 400">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/store-roles')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên users</label>
                                <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                            </div>

                            <button type="submit"  class="btn btn-info">Add users</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
