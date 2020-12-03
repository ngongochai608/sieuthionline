@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-5">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Tài khoản khách hàng thành viên</h1>
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo "<span class='alert alert-success'>".$message."</span>";
                                    Session::put('message',null);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Customer</a></li>
                                    <li class="active">Tài khoản khách hàng</li>
                                </ol>
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
                                <strong class="card-title">Tài khoản khách hàng</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên khách hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Mật khẩu</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer as $key => $c)
                                        <tr>
                                            <td>{{ $c->customer_name }}</td>
                                            <td>{{ $c->customer_phone }}</td>
                                            <td>{{ $c->customer_email }}</td>
                                            <td>******</td>
                                            <td>
                                                <a href="{{URL::to('/edit-customer-admin&'.$c->customer_id)}}" class="btn btn-success">Sửa</a> | 
                                                <a href="{{URL::to('/delete-customer-admin/'.$c->customer_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa tài khoản này ko?')">Xóa</a></td>
                                        </tr>
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