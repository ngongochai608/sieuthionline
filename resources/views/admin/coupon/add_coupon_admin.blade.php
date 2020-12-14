@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Thêm mã khuyến mãi</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            <form action="{{URL::to('/insert-coupon-admin')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên  khuyến mãi</label></div>
                    <div class="col-12 col-md-9"><input type="text" name="coupon_name" class="form-control">
                    @if($errors->has('coupon_name'))
                        <p class="alert alert-danger">{{ $errors->first('coupon_name') }}</p>
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mã khuyến mãi</label></div>
                    <div class="col-12 col-md-9"><input type="text" name="coupon_code" class="form-control">
                    @if($errors->has('coupon_code'))
                        <p class="alert alert-danger">{{ $errors->first('coupon_code') }}</p>
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số lượng</label></div>
                    <div class="col-12 col-md-9"><input type="text" name="coupon_quantity" class="form-control">
                    @if($errors->has('coupon_quantity'))
                        <p class="alert alert-danger">{{ $errors->first('coupon_quantity') }}</p>
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tính năng mã</label></div>
                    <div class="col-12 col-md-6">
                        <input type="radio" name="coupon_feature" value="1">
                        <label>Giảm theo tiền</label><br />
                        <input type="radio" name="coupon_feature" value="2">
                        <label>Giảm theo phần trăm</label>
                        @if($errors->has('coupon_feature'))
                            <p class="alert alert-danger">{{ $errors->first('coupon_feature') }}</p>                  
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nhập số phần trăm hoặc tiền giảm</label></div>
                    <div class="col-12 col-md-9"><input type="text" name="coupon_number" class="form-control">
                    @if($errors->has('coupon_number'))
                        <p class="alert alert-danger">{{ $errors->first('coupon_number') }}</p>
                    @endif
                    </div>
                </div>
                           
                <div class="row form-group">
                    <button type="submit" name="add_coupon" style="margin: 0px auto;" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn thêm mã khuyến mãi này không?')">Thêm mã giảm giá</button>
                </div>
            </form>
        </div>
    </div>
    @endsection