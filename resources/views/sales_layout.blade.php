<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý gian hàng - Siêu thị online</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/sales/css/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/sales/css/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/sales/css/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/sales/css/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/sales/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/sales/css/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/sales/css/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/sales/css/summernote/summernote-bs4.min.css')}}">

  <!-- morris js -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{URL::to('/sales-dashboard')}}" class="brand-link">
        <img src="{{asset('public/sales/images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Quản lý gian hàng</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('public/sales/images/store.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php
              $name = Session::get('shop_name');
              echo $name;
              ?>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/add-product-shop')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm sản phẩm mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/all-product-shop')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liệt kê sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/order-shop')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Đơn hàng
                <span class="right badge badge-danger">8</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/change-password-shop')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Đổi mật khẩu
                <span class="right badge badge-danger">8</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/logout-shop')}}" onclick="return confirm('Bạn có muốn đăng xuất tài khoản không ?')" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Đăng xuất
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('sales_content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('public/sales/js/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/sales/js/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/sales/js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('public/sales/js/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('public/sales/js/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('public/sales/js/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/sales/js/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/sales/js/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('public/sales/js/moment/moment.min.js')}}"></script>
<script src="{{asset('public/sales/js/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/sales/js/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('public/sales/js/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/sales/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/sales/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/sales/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/sales/js/pages/dashboard.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<!-- morris js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- morris chart -->
<script type="text/javascript">
  $(document).ready(function(){
      statistical30days();
      var chart =  new Morris.Bar({

      element: 'chart',
      //option char
      lineColors:['red','blue','#FF6541'],
      parseTime:false,
      stacked:true,
      hideHover:'auto',
      xkey: 'period',
      ykeys: ['sales','quantity'],
      labels: ['Doanh số','Số lượng sản phẩm bán']
    });

    function statistical30days(){
      var _token = $('input[name="_token"]').val();
      $.ajax({
      url:"{{url('/statistical-30-days')}}",
      method:"POST",
      dataType:"JSON",
      data:{_token:_token},
      success:function(data){
         chart.setData(data);
      }
    });
    }

    $('#btn-dashboard-filter').click(function(){
    var _token = $('input[name="_token"]').val();
    var from_date = $('#datepicker').val();
    var to_date = $('#datepicker2').val();

    $.ajax({
      url:"{{url('/filter-by-date')}}",
      method:"POST",
      dataType:"JSON",
      data:{_token:_token,from_date:from_date,to_date:to_date},
      success:function(data){
         chart.setData(data);
      }
    });
  });

  $('.dashboard-filter').change(function(){
    var _token = $('input[name="_token"]').val();
    var dashboard_value = $(this).val();

    $.ajax({
      url:"{{url('/dashboard-filter')}}",
      method:"POST",
      dataType:"JSON",
      data:{_token:_token,dashboard_value:dashboard_value},
      success:function(data){
         chart.setData(data);
      }
    });
  });

  });
</script>

<script type="text/javascript">
  $( function() {
    $( "#datepicker" ).datepicker({
      prevText:"Tháng trước",
      nextText:"Tháng sau",
      dateFormat:"yy-mm-dd",
      dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
      duration:"slow"
    });
    $( "#datepicker2" ).datepicker({
      prevText:"Tháng trước",
      nextText:"Tháng sau",
      dateFormat:"yy-mm-dd",
      dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
      duration:"slow"
    });
  } );
</script>
  
<script>
 CKEDITOR.replace('ckeditor');
 CKEDITOR.replace('ckeditor1');
 CKEDITOR.replace('ckeditor2');
 CKEDITOR.replace('ckeditor3');
 CKEDITOR.replace('id4');
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
            <script type="text/javascript">
             $(document).ready(function() {
              $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                  el.lightGallery({
                    selector: '#imageGallery .lslide'
                  });
                }   
              });  
            });
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
      </body>
      </html>
