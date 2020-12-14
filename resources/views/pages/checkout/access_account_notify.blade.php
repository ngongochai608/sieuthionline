@extends('layout')
@section('content')
<style type="text/css">
    .login-form{
        padding-top: 50px;
        padding-bottom: 120px;
    }
</style>
<div class="container login-form">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Xác nhận tài khoản của bạn</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    $Error = Session::get('Error');
                    if ($message) {
                        echo '<p class="alert alert-success">'.$message.'</p>';
                        Session::put('message',null);
                    }
                    if ($Error) {
                        echo '<p class="alert alert-danger">'.$Error.'</p>';
                        Session::put('Error',null);
                    }
                    ?>
                    <form action="{{URL::to('/access-customer')}}" method="POST" accept-charset="UTF-8" role="form">
                        @csrf
                        <fieldset>
                            <?php
                                $email_customer = $_GET['email'];
                                $token_customer = $_GET['token'];
                            ?>
                            <input type="hidden" name="email_customer" value="{{$email_customer}}">
                            <input type="hidden" name="token_customer" value="{{$token_customer}}">
                            <input type="submit" class="btn btn-default btn-block" value="Xác nhận">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection