<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\shipping;
use App\Models\order;
use App\Models\order_details;
use App\Models\customer;
use Session;
session_start();

class CartController extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
      }else{
         return Redirect::to('admin')->send();
      }
    }
    public function cart(){
        $cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }   
        $shop_id = Session::get('shop_id');
        $customer_id = Session::get('customer_id');
        $customer = customer::where('customer_id',$customer_id)->first();
        $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    	return view('pages.cart.cart')->with(compact('order_new','count_cart','customer'));
    }

    public function payment(){
        $cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }   
    	return view('pages.cart.payment')->with(compact('count_cart'));
    }

    public function update_cart(Request $request){
        $data=$request->all();
        $cart = Session::get('cart');
        if ($cart==true) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($data['product_qty_store'] as $key2 => $qty_store) {
                    if ($key==$key2) {
                        if ($qty<$qty_store) {
                            foreach ($cart as $session => $val) {
                                if ($val['session_id']==$key && $key==$key2) {
                                    $cart[$session]['product_qty']=$qty;
                                }
                            }
                        }else{
                            return Redirect()->back()->with('message_error','Bạn không được đặt số lượng sản phẩm nhiều hơn số lượng sản phẩm có trong kho');
                        }
                    }
                }
            }    
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Đã cập nhập số lượng sản phẩm!');
        }else{
            return Redirect()->back()->with('message_error','Cập nhập số lượng thất bại!');
        }
    }

    public function delete_product_cart($session_id){
        $cart = Session::get('cart');
        if ($cart==true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id']==$session_id) {
                unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Đã xóa sản phẩm khỏi giỏ hàng!');
        }else{
            return Redirect()->back()->with('message','Xóa sản phẩm thất bại!');
        }
    }

    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->order_date = now();
        $order->create_at = now();
        $order->save();

        if (Session::get('cart')==true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new order_details;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->shop_id = $cart['shop_id'];
                $order_details->order_details_status = 0;
                $order_details->save();
            }
        }
        Session::forget('cart');
    }

    public function add_cart(Request $request){
    	$data = $request->all();
    	$session_id = substr(md5(microtime()),rand(0,26),5);
    	$cart = Session::get('cart');
    	if ($cart==true) {
    		$is_aveiable = 0;
    		foreach($cart as $key => $val){
    			if($val['product_id']==$data['cart_product_id']) {
    				$is_aveiable++;
                    $cart[$key]['product_qty'] += $data['cart_product_qty'];
    			}
    		}
    		if ($is_aveiable==0) {
    			$cart[] = array(
    			'session_id' => $session_id,
    			'product_name' => $data['cart_product_name'],
    			'product_id' => $data['cart_product_id'],
    			'product_image' => $data['cart_product_image'],
    			'product_price' => $data['cart_product_price'],
    			'product_qty' => $data['cart_product_qty'],
                'shop_id' => $data['cart_product_shop'],
                'product_quantity_store' => $data['product_quantity'],
                'product_slug' => $data['cart_product_slug'],
                'product_category' => $data['cart_product_category'],
    		);
    			Session::put('cart',$cart);
    		}
    	}else{
    		$cart[] = array(
    			'session_id' => $session_id,
    			'product_name' => $data['cart_product_name'],
    			'product_id' => $data['cart_product_id'],
    			'product_image' => $data['cart_product_image'],
    			'product_price' => $data['cart_product_price'],
    			'product_qty' => $data['cart_product_qty'],
                'shop_id' => $data['cart_product_shop'],
                'product_quantity_store' => $data['product_quantity'],
                'product_slug' => $data['cart_product_slug'],
                'product_category' => $data['cart_product_category'],
    		);
    	}
    	Session::put('cart',$cart);
    	Session::save();
    }
}
