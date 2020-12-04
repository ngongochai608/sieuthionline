<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang quản lý Siêu Thị Online</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('public/backend/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <style>
        #weatherWidget .currentDesc {
            color: #ffffff!important;
        }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
           height: 105px;
       }

       #flotBarChart {
        height: 150px;
    }
    #cellPaiChart{
        height: 160px;
    }

</style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{URL::to('/dashboard')}}"><i class="menu-icon fa fa-laptop"></i>Trang chủ </a>
                    </li>
                    @hasanyroles(['admin','author'])
                    <li class="menu-title">Hàng hóa</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Sản phẩm</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{URL::to('/add-product-admin')}}">Thêm sản phẩm</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{URL::to('/all-product-admin')}}">Liệt kê sản phẩm</a></li>                           
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Danh mục sản phẩm</a>
                        <ul class="sub-menu children dropdown-menu">
                            @hasrole('admin')
                            <li><i class="fa fa-table"></i><a href="{{URL::to('add-category-product-admin')}}">Thêm danh mục</a></li>
                            @endhasrole
                            <li><i class="fa fa-table"></i><a href="{{URL::to('/all-category-product-admin')}}">Liệt kê danh mục</a></li>
                        </ul>
                    </li>
                    @endhasanyroles
                    @hasanyroles(['admin','author','logistics'])
                    <li class="menu-title">Đơn hàng</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Đơn hàng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{URL::to('/manager-order')}}">Liệt kê đơn hàng</a></li>
                        </ul>
                    </li>
                    @endhasanyroles
                    @hasrole('admin')
                    <li class="menu-title">Tài khoản</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Khách hàng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{URL::to('/add-customer-admin')}}">Thêm Customer</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="{{URL::to('/all-customer-admin')}}">Liệt kê Customer</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Gian hàng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{URL::to('/add-shop-admin')}}">Thêm gian hàng</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="{{URL::to('/all-shop-admin')}}">Liệt kê gian hàng</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="{{URL::to('/all-shop-wait-active')}}">Gian hàng chờ duyệt</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="{{URL::to('/all-shop-block')}}">Gian hàng bị khóa</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Quản trị viên</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{URL::to('/add-user')}}">Thêm quản trị viên</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="{{URL::to('/users')}}">Liệt kê quản trị viên</a></li>
                        </ul>
                    </li>
                    @endhasrole
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{URL::to('/dashboard')}}"><img src="{{('public/frontend/images/logo1.png')}}" width="114" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="#"><img src="{{('public/backend/images/logo2.png')}}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <?php
                        $admin_name = Auth::user()->admin_name;
                        if ($admin_name) {
                            echo "<span>".$admin_name."</span>";
                        }
                        ?>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{('public/backend/images/admin.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{URL::to('/change-password-admin')}}"><i class="fa fa-power -off"></i>Đổi mật khẩu</a>
                            <a class="nav-link" href="{{URL::to('/logout-admin')}}"><i class="fa fa-power -off"></i>Đăng xuất</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">




            @yield('admin_content')

            <!-- /.content -->
            <div class="clearfix"></div>
            <!-- Footer -->
            <footer class="site-footer">
                <div class="footer-inner bg-white">
                    <div class="row">

                    </div>
                </div>
            </footer>
            <!-- /.site-footer -->
        </div>


        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="text/javascript" src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
        <!--  Chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

        <!--Chartist Chart-->
        <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
        <script src="assets/js/init/weather-init.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
        <script src="assets/js/init/fullcalendar-init.js"></script>
        <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
        <script>
         CKEDITOR.replace('ckeditor');
         CKEDITOR.replace('ckeditor1');
         CKEDITOR.replace('ckeditor2');
         CKEDITOR.replace('ckeditor3');
         CKEDITOR.replace('id4');
     </script>

     <script type="text/javascript">
         $(document).ready(function(){
            load_gallery();
            function load_gallery(){
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/select-gallery')}}",
                    method:"POST",
                    data:{pro_id:pro_id,_token:_token},
                    success:function(data){
                        $('#gallery_load').html(data);
                    }
                });
            }

            $('#file').change(function(){
                var error = '';
                var files = $('#file')[0].files;

                if(files.length>5){
                    error+='<p>Bạn không được chọn quá 5 ảnh</p>';
                }else if(files.length==''){
                    error+='<p>Chưa có ảnh nào được chọn</p>';
                }else if(files.size>2000000){
                    error+='<p>Bạn không được chọn ảnh lớn hơn 2MB</p>';
                }

                if(error==''){

                }else{
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            });

            $(document).on('blur','.edit_gallery_name',function(){
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/update-gallery-name')}}",
                    method:"POST",
                    data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Cập nhập tên hình ảnh thành công</span>');
                    }
                });
            });

            $(document).on('click','.delete-gallery',function(){
                var x = confirm('Bạn có chắc là muốn xóa hình ảnh này không?');
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(x){
                    $.ajax({
                        url:"{{url('/delete-gallery')}}",
                        method:"POST",
                        data:{gal_id:gal_id,_token:_token},
                        success:function(data){
                            load_gallery();
                            $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }
                    });
                }
            });

            $(document).on('change','.file_image',function(){
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-'+gal_id).files[0];

                var form_data = new FormData();
                form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
                form_data.append('gal_id',gal_id);

                $.ajax({
                    url:"{{url('/update-gallery')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Cập nhập hình ảnh thành công</span>');
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
                document.getElementById('convert_slug').value = slug;
            }

        </script>
        <script>
            jQuery(document).ready(function($) {
                "use strict";


                var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
                ];

                $.plot('#flotPie1', piedata, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            innerRadius: 0.65,
                            label: {
                                show: true,
                                radius: 2/3,
                                threshold: 1
                            },
                            stroke: {
                                width: 0
                            }
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                });

                var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
                ];
                $.plot('#cellPaiChart', cellPaiChart, {
                    series: {
                        pie: {
                            show: true,
                            stroke: {
                                width: 0
                            }
                        }
                    },
                    legend: {
                        show: false
                    },grid: {
                        hoverable: true,
                        clickable: true
                    }

                });

                var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

                var plot = $.plot($('#flotLine5'),[{
                    data: newCust,
                    label: 'New Data Flow',
                    color: '#fff'
                }],
                {
                    series: {
                        lines: {
                            show: true,
                            lineColor: '#fff',
                            lineWidth: 2
                        },
                        points: {
                            show: true,
                            fill: true,
                            fillColor: "#ffffff",
                            symbol: "circle",
                            radius: 3
                        },
                        shadowSize: 0
                    },
                    points: {
                        show: true,
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: false
                    }
                });

                if ($('#traffic-chart').length) {
                    var chart = new Chartist.Line('#traffic-chart', {
                      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                      series: [
                      [0, 18000, 35000,  25000,  22000,  0],
                      [0, 33000, 15000,  20000,  15000,  300],
                      [0, 15000, 28000,  15000,  30000,  5000]
                      ]
                  }, {
                      low: 0,
                      showArea: true,
                      showLine: false,
                      showPoint: false,
                      fullWidth: true,
                      axisX: {
                        showGrid: true
                    }
                });

                    chart.on('draw', function(data) {
                        if(data.type === 'line' || data.type === 'area') {
                            data.element.animate({
                                d: {
                                    begin: 2000 * data.index,
                                    dur: 2000,
                                    from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                    to: data.path.clone().stringify(),
                                    easing: Chartist.Svg.Easing.easeOutQuint
                                }
                            });
                        }
                    });
                }

                if ($('#TrafficChart').length) {
                    var ctx = document.getElementById( "TrafficChart" );
                    ctx.height = 150;
                    var myChart = new Chart( ctx, {
                        type: 'line',
                        data: {
                            labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                            datasets: [
                            {
                                label: "Visit",
                                borderColor: "rgba(4, 73, 203,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(4, 73, 203,.5)",
                                data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                            },
                            {
                                label: "Bounce",
                                borderColor: "rgba(245, 23, 66, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(245, 23, 66,.5)",
                                pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                            },
                            {
                                label: "Targeted",
                                borderColor: "rgba(40, 169, 46, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(40, 169, 46, .5)",
                                pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                            }
                            ]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            }

                        }
                    } );
                }

                $.plot("#flotBarChart", [{
                    data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                    bars: {
                        show: true,
                        lineWidth: 0,
                        fillColor: '#ffffff8a'
                    }
                }], {
                    grid: {
                        show: false
                    }
                });

            });
        </script>
        <script type="text/javascript">
            $('.order_details').change(function(){
                var order_status = $(this).val();
                var order_id = $(this).children(':selected').attr('id');
                var _token = $('input[name="_token"]').val();

            //Lay ra so luong
            quantity = [];
            $("input[name='product_sales_quantity']").each(function(){
                quantity.push($(this).val());
            });
            //Lay ra product_id
            order_product_id = [];
            $("input[name='order_product_id']").each(function(){
                order_product_id.push($(this).val());
            });
            $.ajax({
                url: '{{url('/update-order-quantity')}}',
                method: 'POST',
                data:{order_status:order_status,order_id:order_id,_token:_token,quantity:quantity,order_product_id:order_product_id},
                success:function(){
                    alert('Cập nhập tình trạng đơn hàng thành công!');  
                    location.reload();  
                }
            });                        
        });
    </script>
</body>
</html>
