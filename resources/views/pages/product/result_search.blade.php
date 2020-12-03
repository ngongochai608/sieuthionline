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

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                        </ul>
                    </nav>                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection