@extends('layout')
@section('content')
abcd
<div class="slider-area">
   <!-- Slider -->
   <div class="block-slider block-slider4">
    <ul class="" id="bxslider-home4">
       <li>
          <img src="{{('public/frontend/images/banner1.jpg')}}" alt="Slide">
      </li>
      <li>
        <img src="{{('public/frontend/images/banner2.jpg')}}" alt="Slide">
    </li>
    <li>
        <img src="{{('public/frontend/images/banner3.jpg')}}" alt="Slide">
    </li>
    <li>
        <img src="{{('public/frontend/images/banner4.jpg')}}" alt="Slide">
    </li>
</ul>
</div>
<!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container all-product-index">
        <h3 class="title-home">Khám phá danh mục</h3>
        <hr>
        <div class="row">
            <?php $dem = 1; ?> 
            @foreach($category_product as $key => $category)
            <div class="col-md-2 col-sm-6">  
                <div class="single-promo promo<?php echo $dem ?>"> 
                    <a href="{{URL::to('/danh-muc='.$category->category_slug_product)}}"> 
                        <img src="{{'public/uploads/category_product/'.$category->category_image}}" height="100" width="100"> 
                        <p>{{$category->category_name}}</p> 
                    </a> 
                </div> 
            </div>
            <?php $dem++; ?> 
            @endforeach
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 product-hot">
                <div class="latest-product">
                    <h3 class="title-home">Top sản 10 sản phẩm bán chạy nhất</h3>
                    <hr>
                    <div class="product-carousel">
                        @foreach($product_hot as $key => $pro)
                        <div class="single-product">
                            <a href="{{url('/chi-tiet-san-pham&'.$pro->product_slug.'&'.$pro->shop_id.'&dm='.$pro->category_id)}}">
                                <div class="product-f-image">
                                    <img src="{{('public/uploads/product/'.$pro->product_image)}}" alt="" width="188" height="188">
                                </div>
                                <div class="product-name">
                                    <h2>{{$pro->product_name}}</h2>
                                </div>
                                <div class="product-carousel-price">
                                    <ins style="color: #da1821;">{{number_format($pro->product_price ,0,',','.')}}đ</ins>
                                </div> 
                            </a>
                        </div>                          
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="single-product-area product-relate">
    <div class="container all-product-index">
        <h3 class="title-home">Có thể bạn sẽ thích</h3>
        <hr>
        <div class="row">
            @foreach($product as $key => $pro_all)
            <div class="col-md-2 col-sm-6">   
                <div class="single-product-all">
                    <a href="{{url('/chi-tiet-san-pham&'.$pro_all->product_slug.'&'.$pro_all->shop_id.'&dm='.$pro_all->category_id)}}">
                        <div class="product-image">
                            <img src="{{('public/uploads/product/'.$pro_all->product_image)}}" alt="" width="188" height="188">
                        </div>
                        <div class="product-name">
                            <h2>{{$pro_all->product_name}}</h2>
                        </div>
                        <div class="product-carousel-price">
                            <ins style="color: #da1821;">{{number_format($pro_all->product_price ,0,',','.')}}đ</ins>
                        </div> 
                    </a>                 
                </div> 
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end allproduct -->
@endsection