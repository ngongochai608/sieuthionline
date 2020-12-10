@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tài khoản users</h1>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo "<span class='alert alert-success'>".$message."</span>";
                            Session::put('message',null);
                        }
                        $message_error = Session::get('message_error');
                        if ($message_error) {
                            echo "<span class='alert alert-danger'>".$message_error."</span>";
                            Session::put('message_error',null);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tài khoản users</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên users</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Mật khẩu</th>
                                    <th>Nhân viên</th>
                                    <th>Admin</th>
                                    <th>Logistic</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($admin as $key => $user)
                                @php
                                    $i++;
                                @endphp
                                <form action="{{URL::to('/assign-roles')}}" method="POST">
                                    @csrf                               
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $user->admin_name }}</td>
                                    <td>{{ $user->admin_phone }}</td>
                                    <td>{{ $user->admin_email }}
                                        <input type="hidden" name="admin_email" value="{{$user->admin_email}}">
                                    </td>
                                    <td>******</td>

                                    <td>
                                        <input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}>
                                    </td>

                                    <td>
                                        <input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="logistics_role" {{$user->hasRole('logistics') ? 'checked' : ''}}>
                                    </td>

                                    <td> 
                                        <input class="btn btn-primary btn-sm" type="submit" name="cap-quyen" value="Cấp quyền" onclick="return confirm('Bạn có thật sự muốn cấp quyền cho tài khoản này không?')">
                                        <a style="margin:5px 0;" href="{{URL::to('/delete-user-roles/'.$user->admin_id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có thật sự muốn xóa tài khoản này không?')">Xóa User</a>
                                    </tr>
                                    </form>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


    <div class="clearfix"></div>
    @endsection