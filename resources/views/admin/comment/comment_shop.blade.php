@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-5">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Đánh giá gian hàng chưa duyệt</h1>
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
                                    <li><a href="#">Đánh giá chờ duyệt</a></li>
                                    <li class="active">Đánh giá gian hàng</li>
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
                                <strong class="card-title">Liệt kê đánh giá gian hàng chưa duyệt</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Người đánh giá</th>
                                            <th>Nội dung</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt=0;
                                        ?>
                                        @foreach($comment_shop_wait as $key => $comment_s_wait)
                                        <?php
                                        $stt++;
                                        ?>
                                        <tr>
                                            <td>{{$stt}}</td>
                                            <td>{{$comment_s_wait->comment_name}}</td>
                                            <td>{{$comment_s_wait->comment_content}}</td>
                                            <td>{{$comment_s_wait->comment_date}}</td>
                                            <td><p class="text text-danger">Đang chờ duyệt</p></td>
                                            <td>
                                                <a href="{{URL::to('/active-comment-shop-admin/'.$comment_s_wait->comment_shop_id)}}" class="btn btn-success">Duyệt</a> | 
                                                <a href="{{URL::to('/delete-comment-shop-admin/'.$comment_s_wait->comment_shop_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa đánh giá này không?')">Xóa</a></td>
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