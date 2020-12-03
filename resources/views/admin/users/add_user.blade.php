@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Thêm tài khoản User</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            <form action="{{URL::to('/save-user')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên User</label></div>
                    <div class="col-12 col-md-6"><input type="text" id="slug" name="admin_name" class="form-control">
                    @if($errors->has('admin_name'))
                        <p class="alert alert-danger">{{ $errors->first('admin_name') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="admin_email" class="form-control">
                    @if($errors->has('admin_email'))
                        <p class="alert alert-danger">{{ $errors->first('admin_email') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="admin_password" class="form-control">
                    @if($errors->has('admin_password'))
                        <p class="alert alert-danger">{{ $errors->first('admin_password') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="admin_phone" class="form-control">
                    @if($errors->has('admin_phone'))
                        <p class="alert alert-danger">{{ $errors->first('admin_phone') }}</p>                  
                    @endif</div>
                </div>           
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Thêm User" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn thêm tài khoản user này ko?')">
                </div>
            </form>
        </div>
    </div>
    @endsection