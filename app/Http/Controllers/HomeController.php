<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category_product;
use App\Models\order;
use App\Models\order_details;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    public function index(){
    	$product_hot = product::where('product_status',0)->orderBy('product_sold','DESC')->take(10)->get();
        $product = product::where('product_status',0)->orderBy('product_view','DESC')->take(20)->get();
        $cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }       
        $category_product = category_product::orderby('category_id','desc')->limit(6)->get();
        $shop_id = Session::get('shop_id');
        $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    	return view('pages.home')->with(compact('product_hot','category_product','order_new','count_cart','product'));
    }
    public function search(Request $request){
        $cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }   
        $shop_id = Session::get('shop_id');
        $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    	$keywords = $request->keywords_submit;
    	if ($keywords) {
    		$search_product = product::where('product_name','like','%'.$keywords.'%')->get();
    		return view('pages.product.result_search')->with(compact('search_product','keywords','order_new','count_cart'));
    	}else{
    		return Redirect::to('/');
    	}
    	
    }
}
