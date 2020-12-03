@extends('layout')
@section('content')   
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container product-details">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Sản phẩm mới nhất</h2>
                    @foreach($related_product as $key => $related_pro)
                    <div class="thubmnail-recent">
                        <a href="{{URL::to('/chi-tiet-san-pham&'.$related_pro->product_slug.'&'.$related_pro->shop_id.'&dm='.$related_pro->category_id)}}">
                            <img src="{{('public/uploads/product/'.$related_pro->product_image)}}" class="recent-thumb" alt="">
                            <p>{{$related_pro->product_name}}</p>
                            <div class="product-sidebar-price">
                                <ins style="color: #da1821;">Giá : {{number_format($related_pro->product_price ,0,',','.')}}đ</ins>
                            </div>
                        </a>                             
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="product-images">
                                <ul id="imageGallery">
                                    @foreach($gallery as $key => $gallery_val)
                                    <li data-thumb="{{asset('public/uploads/gallery/'.$gallery_val->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gallery_val->gallery_image)}}">
                                        <img width="100%" height="300" src="{{asset('public/uploads/gallery/'.$gallery_val->gallery_image)}}" alt="{{$gallery_val->gallery_name}}" />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="product-inner">
                                <h2 class="product-name">{{$product_chitiet->product_name}}</h2>
                                <div class="product-inner-price">
                                    <ins style="color: red;">{{number_format($product_chitiet->product_price ,0,',','.')}}đ</ins>
                                </div>    

                                <form class="cart">
                                    @csrf
                                    <input type="hidden" name="" value="{{$product_chitiet->product_id}}" class="cart_product_id_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$product_chitiet->product_name}}" class="cart_product_name_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$product_chitiet->product_image}}" class="cart_product_image_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$product_chitiet->product_price}}" class="cart_product_price_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$product_chitiet->shop_id}}" class="cart_product_shop_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$product_chitiet->product_quantity}}" class="product_quantity_{{$product_chitiet->product_id}}">

                                    <input type="hidden" name="" value="{{$product_chitiet->product_slug}}" class="cart_product_slug_{{$product_chitiet->product_id}}">
                                    <input type="hidden" name="" value="{{$category}}" class="cart_product_category_{{$product_chitiet->product_id}}">
                                    <div class="quantity">
                                        <input type="number" size="4" class="cart_product_qty_{{$product_chitiet->product_id}}" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button type="button" data-id="{{$product_chitiet->product_id}}" class="btn btn-success add-to-cart" name="add-to-cart">Thêm vào giỏ hàng</button>
                                </form>   

                                <div class="product-inner-category">
                                    @if($product_chitiet->product_quantity==0)
                                    <b class="text text-danger">Hết hàng</b>
                                    @else
                                    <p class="text text-success">{{$product_chitiet->product_quantity}} sản phẩm có sẵn</p>
                                    @endif
                                    <p>Danh mục: <a href="{{URL::to('/danh-muc='.$category_by_id->category_slug_product)}}">{{$category_by_id->category_name}}</a></p>
                                </div> 



                            </div>
                        </div>
                    </div>


                </div>                    
            </div>
        </div>

        <div class="row info-shop">
            <h2 class="sidebar-title" style="padding-left: 14px;">Thông tin cửa hàng</h2>
            <div class="col-md-1">
                <img src="public/sales/images/store.png" width="100%" class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <p style="font-size: 2rem;">{{$shop->shop_name}}</p>
                <a href="{{URL::to('/chi-tiet-shop&'.$shop->shop_id)}}" class="btn btn-default btn-sm">Xem shop</a>
            </div>
            <div class="col-md-3">
                <p>Đánh giá : <i style="color: orange;">500</i></p>
                <p>Sản phẩm : <i style="color: orange;">100</i></p>
            </div>
            <div class="col-md-4">
                <p>Địa chỉ : <i style="color: orange;"> {{$shop->shop_address}}</i></p>
                <p>Số điện thoại : <i style="color: orange;"> {{$shop->shop_phone}}</i></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <div role="tabpanel" style="padding-top: 30px;">
                <ul class="product-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Đánh giá về sản phẩm</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <h2>MÔ TẢ SẢN PHẨM</h2>  
                        <p>{!!$product_chitiet->product_desc!!}</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="public/frontend/images/user.jpg" width="100%" class="img-thumbnail">
                            </div>
                            <div class="col-md-10">
                                <p class="text text-primary" style="margin-bottom:-2px;">Hải đẹp trai</p>
                                <span class="text text-muted">02-12-2020</span>
                                <p>Những câu thơ hay về cuộc sống vô cùng ngắn gọn mà sâu sắc, để ta hiểu hơn về những thăng trầm trong cuộc sống, hiểu hơn về lòng người, hiểu hơn về nhân sinh. Những câu thơ hay về cuộc sống mang triết lý về cuộc sống, để chúng ta đủ thương, đủ bao dung, để để hiểu chuyện – dài lâu…</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="single-product-area product-relate">
    <div class="container product-details">
        <div class="row">
            <div class="col-md-12 product-hot">
                <div class="latest-product">
                    <h3 class="sidebar-title">Sản phẩm tương tự được mua nhiều nhất có thể bạn sẽ thích</h3>
                    <hr>
                    <div class="product-carousel">
                        @foreach($product_relate as $key => $pro_rela)
                        <div class="single-product">
                            <a href="{{url('/chi-tiet-san-pham&'.$pro_rela->product_slug.'&'.$pro_rela->shop_id.'&dm='.$pro_rela->category_id)}}">
                                <div class="product-f-image">
                                    <img src="{{('public/uploads/product/'.$pro_rela->product_image)}}" alt="" width="188" height="188">
                                </div>
                                <div class="product-name">
                                    <h2>{{$pro_rela->product_name}}</h2>
                                </div>
                                <div class="product-carousel-price">
                                    <ins style="color: #da1821;">{{number_format($pro_rela->product_price ,0,',','.')}}đ</ins>
                                </div> 
                            </a>
                        </div>                          
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection