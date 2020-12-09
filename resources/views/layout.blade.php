<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siêu Thị Online</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    
    <!-- Bootstrap -->
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Font Awesome -->
    
    <!-- Custom CSS -->
    <link href="{{asset('public/frontend/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">

    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <!-- sweetalert -->
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
</head>
<body>

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-phone"></i> 0969710597</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Yêu thích</a></li>
                            <li><a href="{{URL::to('/register-shop')}}"><i class="fa fa-user"></i>Đăng ký gian hàng</a></li>           
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id!=NULL) {
                                ?>
                                <li class="dropdown dropdown-small">
                                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="value">
                                        <?php
                                        $customer_name = Session::get('customer_name');
                                        echo $customer_name;
                                        ?>
                                    </span><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a style="float: left;" href="{{URL::to('/change-password-customer')}}">Đổi mật khẩu</a></li>
                                        <li><a style="float: left;" href="{{URL::to('/order-customer')}}">Kiểm tra đơn hàng</a></li>
                                        <li><a style="float: left;" href="{{URL::to('/logout-customer')}}">Đăng xuất</a></li>
                                    </ul>
                                </li>
                                <?php
                            }else if($customer_id==NULL) {
                                ?>
                                <li class="dropdown dropdown-small">
                                    <a href="{{URL::to('/login-customer')}}">Đăng nhập</a>
                                </li>|
                                <li class="dropdown dropdown-small">
                                    <a href="{{URL::to('/register-customer')}}">Đăng ký</a>
                                </li>
                                <?php                                  
                            }
                            ?>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-collapse collapse">
                    <div class="logo" style="float: left;">
                        <a href="./trangchu"><img src="{{('public/frontend/images/logo1.png')}}" width="150"></a>
                    </div>
                    <form class="form-inline active-cyan-4" action="{{URL::to('/tim-kiem')}}" method="POST" style="float: left;padding-left: 150px; padding-top: 12px;">
                        {{ csrf_field() }}
                        <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Nhập tên sản phẩm cần tìm..." style="width: 450px;height: 40px;" name="keywords_submit">
                        <input type="submit" name="search_items" class="btn btn-primary btn-sm btn-search" value="Tìm kiếm">
                    </form>
                    @if(Session::get('customer_id')!=NULL)
                    <div class="shopping-item">
                        <a href="{{URL::to('/cart')}}"><i class="fa fa-shopping-cart fa-lg"></i> 
                            <span class="product-count" style="background: red;">{{$count_cart}}</span></a>
                        </div>
                        @elseif(Session::get('customer_id')==NULL)
                        <div class="shopping-item">
                            <a href="{{URL::to('/login-customer')}}"><i class="fa fa-shopping-cart fa-lg"></i></a>
                        </div>
                        @endif
                    </div>  
                </div>
            </div>
        </div> <!-- End mainmenu area -->
        @yield('content')
        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-about-us">
                            <h2><span>Liên Hệ Siêu Thị Online</span></h2>
                            <p> Hotline & Chat trực tuyến (24/7)<br/>
                                Trung tâm hỗ trợ<br/>
                                Hướng dẫn đặt hàng<br/>
                                Giao hàng & Nhận hàng<br/>
                                Chính sách hàng nhập khẩu<br/>
                            Hướng dẫn đổi trả hàng</p>
                            <div class="footer-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">Siêu Thị Online Việt Nam </h2>
                            <ul>    
                                <li><a href="#">Bán hàng cùng Siêu thị Online</a></li>
                                <li><a href="#">Chương trình Siêu thị Online</a></li>
                                <li><a href="#">Tuyển dụng</a></li>
                                <li><a href="#">Điều khoản sử dụng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Báo chí</a></li>
                                <li><a href="#">Bảo vệ quyền sở hữu trí tuệ</a></li>
                                <li><a href="#">Quy chế hoạt động sàn Siêu thị Online</a></li>
                                <li><a href="#">Điều Khoản Công Cụ Tương Tác</a></li>
                            </ul>                        
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">Danh mục sản phẩm</h2>
                            <ul>
                                <li><a href="#">Phụ kiện</a></li>
                                <li><a href="#">Đồ nội thất</a></li>
                                <li><a href="#">Thời trang</a></li>
                                <li><a href="#">Mẹ và bé</a></li>
                                <li><a href="#">Thiết bị gia dụng</a></li>
                                <li><a href="#">Đồ điện tử</a></li>
                            </ul>                        
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End footer top area -->

        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <div class="footer-card-icon">
                            <p style="font-size: 14px;">Siêu thị online 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End footer bottom area -->

        <!-- Latest jQuery form server -->

        <script src="https://code.jquery.com/jquery.min.js"></script>

        <!-- Bootstrap JS form CDN -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <!-- jQuery sticky menu -->
        <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/jquery.sticky.js')}}"></script>

        <!-- jQuery easing -->
        <script src="{{asset('public/frontend/js/jquery.easing.1.3.min.js')}}"></script>

        <!-- Main Script -->
        <script src="{{asset('public/frontend/js/main.js')}}"></script>

        <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
        <script src="{{asset('public/frontend/js/prettify.js')}}"></script>

        <!-- Slider -->
        <script type="text/javascript" src="{{asset('public/frontend/js/bxslider.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/frontend/js/script.slider.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/frontend/js/choices.js')}}"></script>
        <!-- SweetAlert -->
        <script type="text/javascript" src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
        <!-- /SweetAlert -->
        <script>
          const choices = new Choices('[data-trigger]',
          {
            searchEnabled: false,
            itemSelectText: '',
        });

    </script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script>
     CKEDITOR.replace('ckeditor');
     CKEDITOR.replace('ckeditor1');
     CKEDITOR.replace('ckeditor2');
     CKEDITOR.replace('ckeditor3');
     CKEDITOR.replace('id4');
 </script>


 <script type="text/javascript">
    function remove_background(shop_id){
        for(var count=1;count<=5;count++){
            $('#'+shop_id+'-'+count).css('color','#ccc');
        }
    }
    $(document).on('mouseenter','.rating',function(){
        var index = $(this).data("index");
        var shop_id = $(this).data("shop_id");
        remove_background(shop_id);
        for(var count=1;count<=index;count++){
            $('#'+shop_id+'-'+count).css('color','#ffcc00');
        }
    });

    $(document).on('mouseleave','.rating',function(){
        var index = $(this).data("index");
        var shop_id = $(this).data("shop_id");
        var rating = $(this).data("rating");
        remove_background(shop_id);
        for(var count=1;count<=rating;count++){
            $('#'+shop_id+'-'+count).css('color','#ffcc00');
        }
    });

    $(document).on('click','.rating',function(){
        var index = $(this).data("index");
        var shop_id = $(this).data("shop_id");
        var feedback_id = $(this).data("feedback_id");
        var customer_name = $(this).data("customer_name");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('/insert-rating-shop')}}",
            method: 'POST',
            data:{index:index,shop_id:shop_id,feedback_id:feedback_id,customer_name:customer_name,_token:_token},
            success:function(data){
                if (data=='done'){
                    alert('Cảm ơn bạn đã đánh giá');
                    location.reload();
                }else{
                    alert('Lỗi đánh giá');
                }
            }
        });    
    });

</script>

<script type="text/javascript">
 $(document).ready(function(){
    load_comment();
    function load_comment(){
        var shop_id = $('.comment_shop_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/load-comment')}}',
            method: 'POST',
            data:{shop_id:shop_id,_token:_token},
            success:function(data){
                $('#comment_show').html(data);
            }
        });    
    }
    $('.send-comment-product').click(function(){
        var product_id = $('.product_id').val();
        var comment_name = $('.comment_name').val();
        var comment_content = $('.comment_content').val();
        var order_details_id = $('.order_details_id').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/send-comment-product')}}',
            method: 'POST',
            data:{order_details_id:order_details_id,product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
            success:function(data){
                alert('Cảm ơn bạn đã đánh giá về sản phẩm!');
                location.reload();
            }
        });   
    });
});
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
           $(document).ready(function(){

            $('.cancel-order').click(function(){
                var order_code = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                swal({
                    title: "Hủy đơn hàng",
                  text: "Bạn có chắc chắn là muốn hủy đơn hàng này không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Xác nhận, hủy đơn!",
                  closeOnConfirm: false
              },
              function(){
                   $.ajax({
                        url: '{{url('/cancel-order')}}',
                        method: 'POST',
                        data:{order_code:order_code,_token:_token},
                        success:function(){
                            swal("Thành công!", "Đã hủy đơn hàng.", "success");
                            location.reload();
                        }
                    }); 
                  
              });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var cart_product_shop = $('.cart_product_shop_' + id).val();
                var product_quantity = $('.product_quantity_' + id).val();

                var cart_product_slug = $('.cart_product_slug_' + id).val();
                var cart_product_category = $('.cart_product_category_' + id).val();
                var _token = $('input[name="_token"]').val();
                if (parseInt(cart_product_qty)>parseInt(product_quantity)) {
                    swal("Bạn không được đặt số lượng sản phẩm lớn hơn số lượng có sẵn");
                }else{
                    $.ajax({
                        url: '{{url('/add-cart')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_shop:cart_product_shop,product_quantity:product_quantity,cart_product_slug:cart_product_slug,cart_product_category:cart_product_category},
                        success:function(){
                            swal({
                              title: "Đã thêm sản phẩm vào giỏ hàng?",
                              text: "Bạn có thể ở lại trang này hoặc đi đến giỏ hàng để thanh toán!",
                              showCancelButton: true,
                              cancelButtonText: "Xem tiếp",
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Đi đến giỏ hàng",
                              closeOnConfirm: false,
                          },
                          function() {
                              window.location.href = "{{URL('/cart')}}";
                          });
                        }
                    });
                }      
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                var shipping_name = $('.shipping_name').val();
                var shipping_email = $('.shipping_email').val();
                var shipping_phone = $('.shipping_phone').val();
                var shipping_address = $('.shipping_address').val();
                var shipping_method = $('.payment_select').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/confirm-order')}}',
                    method: 'POST',
                    data:{shipping_name:shipping_name,shipping_email:shipping_email,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_method:shipping_method,_token:_token},
                    success:function(){
                        swal({
                          title: "Đặt hàng thành công!",
                          text: "Cảm ơn bạn đã đặt hàng!",
                          type: "success",
                          confirmButtonClass: "btn-primary",
                          confirmButtonText: "OK",
                          closeOnConfirm: false
                      },
                      function(){
                          window.location.href = "{{URL('/trangchu')}}";  
                      });                
                    }
                });                             
            });
        });
    </script>
</body>
</html>