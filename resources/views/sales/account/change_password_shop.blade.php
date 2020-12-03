@extends('sales_layout')
@section('sales_content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm sản phẩm mới</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
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
    <form action="{{URL::to('/change-password-sh')}}" method="post" enctype="multipart/form-data" accept-charset="UTF-8" role="form">
      {{ @csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nhập mật khẩu hiện tại</label>
          <input type="password" style="margin-top: 10px;" name="password_shop_old" class="form-control">@if($errors->has('password_shop_old'))
          <p class="alert alert-danger">{{ $errors->first('password_shop_old')}}</p>
          @endif
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Nhập mật khẩu mới</label>
          <input type="password" id="hf-password" name="password_shop_new" class="form-control">@if($errors->has('password_shop_new'))
          <p class="alert alert-danger">{{ $errors->first('password_shop_new')}}</p>
          @endif
      </div>
      <div class="form-group">
          <label for="disabled-input" class=" form-control-label">Nhập xác nhận mật khẩu mới</label>
          <input type="password" id="hf-password" name="password_shop_new_confirm" class="form-control">@if($errors->has('password_shop_new_confirm'))
          <p class="alert alert-danger">{{ $errors->first('password_shop_new_confirm')}}</p>
          @endif
      </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <input type="submit" onclick="return confirm('Bạn có chắc là muốn thay đổi mật khẩu tài khoản gian hàng không?')" class="btn btn-success btn-block" value="Thay đổi mật khẩu">
</div>
</form>
</div>
</div>
</div>
</div>
@endsection