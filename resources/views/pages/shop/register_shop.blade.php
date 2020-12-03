@extends('layout')
@section('content')
<div class="container login-container">
  <div class="row">
    <div class="col-md-12 login-form">
      <div class="profile-img">
        <img src="{{asset('public/frontend/images/shop_icon.png')}}" width="140" height="111">
      </div>
      <h3>Đăng ký gian hàng</h3>
      <?php
      $message = Session::get('message');
      if ($message) {
        echo '<p class="alert alert-success">'.$message.'</p>';
        Session::put('message',null);
      }
      ?>
      <form action="{{URL::to('/save-shop')}}" method="post">
        {{ @csrf_field() }}
        <div class="form-group">
          <input type="text" style="margin-top: 10px;" name="shop_name" placeholder="Tên gian hàng" class="form-control">
          @if($errors->has('shop_name'))
          <p class="alert alert-danger">{{ $errors->first('shop_name') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="text" style="margin-top: 10px;" name="name_shop_owner" placeholder="Tên chủ gian hàng" class="form-control">
          @if($errors->has('name_shop_owner'))
          <p class="alert alert-danger">{{ $errors->first('name_shop_owner') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="text" name="shop_email" placeholder="Email" class="form-control">
          @if($errors->has('shop_email'))
          <p class="alert alert-danger">{{ $errors->first('shop_email') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="text" name="shop_phone" placeholder="Số điện thoại" class="form-control">@if($errors->has('shop_phone'))
          <p class="alert alert-danger">{{ $errors->first('shop_phone') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="password" name="shop_password" placeholder="Mật khẩu" class="form-control">@if($errors->has('shop_password'))
          <p class="alert alert-danger">{{ $errors->first('shop_password') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="password" name="shop_password_confirm" placeholder="Nhập lại mật khẩu" class="form-control">@if($errors->has('shop_password_confirm'))
          <p class="alert alert-danger">{{ $errors->first('shop_password_confirm') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="text"  name="shop_address" placeholder="Địa chỉ" class="form-control">@if($errors->has('shop_address'))
          <p class="alert alert-danger">{{ $errors->first('shop_address') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="submit" name="" class="btn btn-lg btn-success btn-block" value="Đăng ký gian hàng">
        </div>
        <div class="form-group forget-password">
          <span>Bạn đã có gian hàng? <a href="{{URL::to('/sales')}}"><strong>Đăng nhập tại đây</strong></a></span>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection