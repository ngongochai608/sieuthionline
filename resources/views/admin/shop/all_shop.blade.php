@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tài khoản gian hàng thành viên</h1>
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
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tài khoản gian hàng</strong>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên gian hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_shop as $key => $s)
                                <tr>
                                    <td>{{ $s->shop_name }}</td>
                                    <td>{{ $s->shop_phone }}</td>
                                    <td>{{ $s->shop_email }}</td>
                                    <td>{{ $s->shop_address }}</td>
                                    <td>
                                        <p class="btn btn-success btn-sm active">Đang hoạt động</p>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/char-details-shop&'.$s->shop_id)}}" class="btn btn-primary btn-sm btn-block">Xem chi tiết</a>
                                        <a href="{{URL::to('/edit-shop-admin&'.$s->shop_id)}}" class="btn btn-success btn-sm btn-block">Sửa</a>
                                        <a href="{{URL::to('/delete-shop-admin/'.$s->shop_id)}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Bạn có chắc là muốn xóa tài khoản gian hàng này không?')">Xóa</a>
                                        <a class="btn btn-warning btn-sm btn-block" href="{{URL::to('/unactive-shop/'.$s->shop_id)}}" onclick="return confirm('Bạn có chắc là muốn khóa tài khoản gian hàng này không?')">Khóa</a>
                                    </td>
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