@extends('layout')
@section('content')
<div class="single-product-area">
  <div class="container  product-relate">
    <div class="row all-product-index">
      <div class="card">
        <div class="card-header">
          <div class="row" style="height: 100px;">
            <div class="col-md-4">
              <strong style="padding-left: 30px;font-size: 15px;"><img src="public/frontend/images/account.png" height="35" width="35"> {{$shop->shop_name}}</strong>
              <ul class="list-inline" title="Đánh giá sao" style="padding-left: 30px;font-size: 15px;width: ">
                  @for($count=1;$count<=5;$count++)
                  @php
                  if($count<=$rating){
                  $color='#ffcc00';
                  }else{
                  $color='#ccc';
                  }
                  @endphp
                  <li title="Đánh giá sao"
                  id="" 
                  data-index=""
                  data-product_id=""
                  data-rating=""
                  class="rating"
                  style="cursor: pointer;color:{{$color}};font-size: 20px;">
                  &#9733;
                  </li>
                  @endfor
                  <br/>
                  <p style="padding-left: 7px;color: #808080;">Đánh giá ({{$rating_count}})</p>
              </ul>
              
      </div>
      <div class="col-md-8">

      </div>
    </div>
  </div>
  <div class="profile_shop"></div>
  <div class="tab_profile_shop">
    <button class="tablinks" onclick="openCity(event, 'product')">Sản phẩm</button>
    <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'ViewComment')">Xem đánh giá</button>
  </div>
  <div id="product" class="tabcontent_profile_shop">
    <div class="row">
      @foreach($product_shop as $key => $product_s)
      <div class="col-md-2 col-sm-6">   
        <div class="single-product-all">
          <a href="{{url('/chi-tiet-san-pham&'.$product_s->product_slug.'&'.$product_s->shop_id.'&'.'dm='.$product_s->category_id)}}">
            <div class="product-image">
              <img src="{{('public/uploads/product/'.$product_s->product_image)}}" alt="" width="188" height="188">
            </div>
            <div class="product-name">
              <h2>{{$product_s->product_name}}</h2>
            </div>
            <div class="product-carousel-price">
              <ins style="color: #da1821;">{{number_format($product_s->product_price ,0,',','.')}}đ</ins>
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


  <div id="ViewComment" class="tabcontent_profile_shop">
    <form>
      @csrf
      <input type="hidden" name="comment_shop_id" class="comment_shop_id" value="{{$shop->shop_id}}">
      <div id="comment_show">
      </div>
    </form>
  </div>
  
</div>
</div>
</div>




<script>
  function openCity(evt, cityName) {
    var i, tabcontent_profile_shop, tablinks;
    tabcontent_profile_shop = document.getElementsByClassName("tabcontent_profile_shop");
    for (i = 0; i < tabcontent_profile_shop.length; i++) {
      tabcontent_profile_shop[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  document.getElementById("defaultOpen").click();
</script>

@endsection