@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Đổi mật khẩu</strong>
        </div>
        <?php
        $message = Session::get('message');
        if ($message) {
            echo '<p class="alert alert-success">'.$message.'</p>';
            Session::put('message',null);
        }
        $message_error = Session::get('message_error');
        if ($message_error) {
            echo '<p class="alert alert-danger">'.$message_error.'</p>';
            Session::put('message_error',null);
        }
        ?>
        <div class="card-body card-block">
            <form action="{{URL::to('/change-password-admin-form')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mật khẩu hiện tại</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_old" class="form-control">
                        @if($errors->has('password_old'))
                        <p class="alert alert-danger">{{ $errors->first('password_old') }}</p>                  
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Mật khẩu mới</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_new" class="form-control">
                        @if($errors->has('password_new'))
                        <p class="alert alert-danger">{{ $errors->first('password_new') }}</p>                  
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Nhập lại mật khẩu mới</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_new_confirm" class="form-control">
                        @if($errors->has('password_new_confirm'))
                        <p class="alert alert-danger">{{ $errors->first('password_new_confirm') }}</p>                  
                    @endif</div>
                </div>         
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Đổi mật khẩu" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn đổi mật khẩu tài khoản không?')">
                </div>
            </form>
        </div>
    </div>
    @endsection