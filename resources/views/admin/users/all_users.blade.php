@extends('admin_layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Users list
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert" style="color: red; font-size:30px; font-weight: 400">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>

                        <th>user</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Author</th>
                        <th>Admin</th>
                        <th>User</th>

                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin as $key => $user)
                        <form action="{{url('/assign-roles')}}" method="POST">
                            @csrf
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                <td>{{ $user->admin_name }}</td>
                                <td>{{ $user->admin_email }} <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                                <input type="hidden" name="admin_id" value="{{ $user->admin_id }}"></td>
                                <td>{{ $user->admin_password }}</td>
                                <td><input type="checkbox" name="author_role" value="2" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                                <td><input type="checkbox" name="admin_role" value="1"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                                <td><input type="checkbox" name="user_role" value="3"  {{$user->hasRole('user') ? 'checked' : ''}}></td>

                                <td>


                                    <p><input type="submit" value="Assign roles" class="btn btn-sm btn-default"></p>
                                    <p><a class="btn btn-sm btn-danger" style="margin: 5px 0" href="{{url('/delete-user-roles/'.$user->admin_id)}}" onclick="return confirm('Are you want to delete ?')">Delete</a></p>
                                    <p><a class="btn btn-sm btn-success" style="margin: 5px 0" href="{{url('/impersonate/'.$user->admin_id)}}" onclick="return confirm('Are you want to change ?')">Change</a></p>

                                </td>

                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!!$admin->links()!!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
