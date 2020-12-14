<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\shipping;
use App\Models\order;
use App\Models\order_details;
use App\Models\customer;
use App\Models\coupon;
use Session;
use Auth;
session_start();

class CouponController extends Controller
{
	public function AuthLogin(){
		$admin_id = Auth::id();
		if($admin_id) {
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('admin')->send();
		}
	}

     public function check_coupon(Request $request){
        $data = $request->all();
        print_r($data);
    }

    public function add_coupon_admin(){
    	$this->AuthLogin();
    	return view('admin.coupon.add_coupon_admin');
    }

    public function insert_coupon_admin(Request $request){
    	$this->AuthLogin();
    	$rules=[
            'coupon_name' => 'required|max:50',
            'coupon_code' => 'required|unique:tbl_coupon,coupon_code',
            'coupon_quantity' => 'required|numeric',
            'coupon_feature' => 'required',
            'coupon_number' => 'required|numeric',
        ];

        $message=[
        	'coupon_name.required' => 'Bạn chưa nhập tên mã khuyến mãi',
            'coupon_name.max' => 'Tên mã khuyến mãi không được vượt quá 50 ký tự',

            'coupon_code.required' => 'Bạn chưa nhập mã khuyến mãi',
            'coupon_code.unique' => 'Mã khuyến mãi này đã tồn tại',

            'coupon_quantity.required' => 'Bạn chưa nhập số lượng mã khuyến mãi',
            'coupon_quantity.numeric' => 'Số lượng phải là ký tự số',

            'coupon_feature.required' => 'Bạn chưa chọn phương thức áp dụng cho mã khuyến mãi',

            'coupon_number.required' => 'Bạn chưa nhập số tiền hoặc số phần trăm cho mã khuyến mãi',
            'coupon_number.numeric' => 'Số tiền hoặc số phần trăm cho mã khuyến mãi phải là ký tự số',
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        }else{
            $data = $request->all();
            $coupon = new coupon();
            $coupon->coupon_name = $data['coupon_name'];
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->coupon_quantity = $data['coupon_quantity'];
            $coupon->coupon_feature = $data['coupon_feature'];
            $coupon->coupon_number = $data['coupon_number'];
            $coupon->save();
            return Redirect::to('/add-coupon-admin')->with('message','Thêm mã khuyến mãi thành công !');
        }
    	
    }
}
