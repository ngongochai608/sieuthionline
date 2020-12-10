<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\order;
use App\Models\order_details;
use App\Models\shipping;
use App\Models\customer;
use App\Models\shop;
use App\Models\product;
use PDF;
use Session;
use Auth;
session_start();

class OrderController extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
      }else{
         return Redirect::to('admin')->send();
      }
    }
    public function order_access_sales($order_details_id){
    order_details::where('order_details_id',$order_details_id)->update(['order_details_status'=>1]);
    Session::put('message','Đã khóa tài khoản gian hàng');
    return Redirect::to('order-shop')->with('message','Đã xác nhận đơn hàng');
    }

    public function delete_order_admin($order_code){
        $order = order::where('order_code',$order_code)->first();
        $order_details = order_details::where('order_code',$order_code)->delete();
        $shipping_id = $order->shipping_id;
        $order->delete();
        $shipping = shipping::where('shipping_id',$shipping_id)->delete();
        return Redirect::to('manager-order')->with('message','Xóa đơn hàng thành công');
    }

    public function cancel_order(Request $request){
        $order_code = $request['order_code'];
        order::where('order_code',$order_code)->update(['order_status'=>4]);
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = order_details::where('order_code',$checkout_code);
        $order = order::where('order_code',$checkout_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $shop_id = $ord->shop_id;
        }
        
        $customer = customer::where('customer_id',$customer_id)->first();
        $shipping = shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = order_details::with('product')->where('order_code',$checkout_code)->join('tbl_shop','tbl_order_details.shop_id','=','tbl_shop.shop_id')->get();

        $output ='';

        $output.='
        <style>
            body{
            font-family:DejaVu Sans;
            }
            .table-styling{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .table-styling thead tr th{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .table-styling tbody tr td{
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
        <h1><center>Đơn hàng siêu thị online</center></h1>
        <h3>Thông tin người đặt hàng</h3>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách đặt</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>';

        $output.='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>
                </tr>';

        $output.='
            </tbody>
        </table>

        <h3>Thông tin người nhận hàng</h3>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách nhận</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ nhận</th>
                </tr>
            </thead>
            <tbody>';

        $output.='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_email.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                </tr>';

        $output.='
            </tbody>
        </table>

        <h3>Thông tin sản phẩm</h3>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Gian hàng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>';
            $total=0;
            foreach ($order_details_product as $key => $order_details_pro){
                $subtotal = $order_details_pro->product_price*$order_details_pro->product_sales_quantity;
                $total+=$subtotal;
        $output.='
                <tr>
                    <td>'.$order_details_pro->product_name.'</td>
                    <td>'.number_format($order_details_pro->product_price ,0,',','.').'đ</td>
                    <td>'.$order_details_pro->product_sales_quantity.'</td>
                    <td>'.$order_details_pro->shop_name.'</td>
                    <td>'.number_format($subtotal ,0,',','.').'đ</td>
                </tr>
                ';
            }

        $output.='
            </tbody>
        </table>
        <h3>Thanh toán</h3>
        <p>Phí vận chuyển : <b>30.000đ</b></p>
        <p>Thành tiền : <b>'.number_format($total+30000 ,0,',','.').'đ</b></p>
        <h3>Ký tên</h3>
        <table>
            <tr>
                <td width="300">
                    <p>Người giao hàng</p>
                </td>
                <td width="300">
                    <p>Người nhận</p>
                </td>
            </tr>
        </table>
            
            
        '
        ;

        return $output;
    }

    public function update_order_quantity(Request $request){
        $data = $request->all();
        $order = order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if ($order->order_status==3) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product=product::find($product_id);
                $product_quantity=$product->product_quantity;
                $product_sold=$product->product_sold;
                foreach ($data['quantity'] as $key2 => $sale_quantity) {
                    if ($key==$key2) {
                        $product_remain=$product_quantity-$sale_quantity;
                        $product->product_quantity=$product_remain;
                        $product->product_sold=$product_sold+$sale_quantity;
                        $product->save();
                    }            
                }
            }
        }elseif ($order->order_status==1) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product=product::find($product_id);
                $product_quantity=$product->product_quantity;
                $product_sold=$product->product_sold;
                foreach ($data['quantity'] as $key2 => $sale_quantity) {
                    if ($key==$key2) {
                        $product_remain=$product_quantity+$sale_quantity;
                        $product->product_quantity=$product_remain;
                        $product->product_sold=$product_sold+$sale_quantity;
                        $product->save();
                    }            
                }
            }
        }
    }


    public function manager_order(){
        $this->AuthLogin();
    	$order = order::orderby('create_at','DESC')->get();
    	return view('admin.order.manager_order_admin')->with(compact('order'));
    }
    public function view_details_order($order_code){
    	$order_details = order::where('order_code',$order_code)->first();
    	$order = order::where('order_code',$order_code)->get();
    	foreach ($order as $key => $ord) {
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
            $shop_id = $ord->shop_id;
    	}
        $order_details_product = order_details::with('product')->where('order_code',$order_code)->join('tbl_shop','tbl_order_details.shop_id','=','tbl_shop.shop_id')->get();
    	$customer = customer::where('customer_id',$customer_id)->first();
    	$shipping = shipping::where('shipping_id',$shipping_id)->first();
    	return view('admin.order.order_view_details')->with(compact('order_details','customer','shipping','order_details_product','order'));
    }
}
