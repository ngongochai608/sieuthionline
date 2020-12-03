<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('public/backend/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                         <h1>ADMIN</h1>
                    </a>
                </div>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo "<span class='alert alert-danger'>$message</span>";
                    Session::put('message',null);
                }
                ?>
                <div class="login-form">
                    <form action="{{URL::to('/login')}}" method="post">
                        {{ csrf_field() }}                      
                        <div class="form-group">
                            <input type="text" name="admin_email" class="form-control" placeholder="Email">
                            @if ($errors->has('admin_email'))
                                <p class="alert alert-danger">{{ $errors->first('admin_email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" name="admin_password" class="form-control" placeholder="Mật khẩu">
                            @if ($errors->has('admin_password'))
                                <p class="alert alert-danger">{{ $errors->first('admin_password') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                        </div>
                        <input type="submit" name="dangnhapadmin" value="Đăng nhập" class="btn btn-success btn-flat m-b-30 m-t-30"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
