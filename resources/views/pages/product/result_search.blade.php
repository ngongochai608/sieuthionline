@extends('layout')
@section('content')
<div class="single-product-area product-relate">
    <div class="container all-product-index">
        <h3 class="title-home">Kết quả tìm kiếm cho từ khóa : "{{ $keywords }}"</h3>
        <hr>
        <div class="row">
            @foreach($search_product as $key => $search)
            <div class="col-md-2 col-sm-6">   
                <div class="single-product-all">
                    <a href="{{url('/chi-tiet-san-pham&'.$search->product_slug.'&'.$search->shop_id.'&dm='.$search->category_id)}}">
                        <div class="product-image">
                            <img src="{{('public/uploads/product/'.$search->product_image)}}" alt="" width="180" height="180">
                        </div>
                        <div class="product-name">
                            <h2>{{$search->product_name}}</h2>
                        </div>
                        <div class="product-carousel-price">
                            <ins style="color: #da1821;">{{number_format($search->product_price ,0,',','.')}}đ</ins>
                        </div> 
                    </a>                 
                </div> 
            </div>
            @endforeach
        </div>
</div>
</div>
@endsection