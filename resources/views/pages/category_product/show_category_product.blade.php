@extends('layout')
@section('content')
<div class="single-product-area product-relate">
    <div class="container all-product-index">
        <div class="row">
                <div class="card-header">
                    <div class="row form-group">
                        <span style="padding-left: 30px;font-size: 16px;">Danh mục <i class="fa fa-angle-right"></i> {{$name_category->category_name}}</span>
                        <hr>
                    </div>
                </div>
                @foreach($category_by_slug as $key => $category_slug)
                <div class="col-md-2 col-sm-6">   
                    <div class="single-product-all">
                        <a href="{{url('/chi-tiet-san-pham&'.$category_slug->product_slug.'&'.$category_slug->shop_id.'&dm='.$category_slug->category_id)}}">
                            <div class="product-image">
                                <img src="{{('public/uploads/product/'.$category_slug->product_image)}}" alt="" width="180" height="180">
                            </div>
                            <div class="product-name">
                                <h2>{{$category_slug->product_name}}</h2>
                            </div>
                            <div class="product-carousel-price">
                                <ins style="color: #da1821;">{{number_format($category_slug->product_price ,0,',','.')}}đ</ins>
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