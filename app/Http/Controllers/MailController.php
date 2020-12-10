<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\customer;
use Session;

class MailController extends Controller
{
    public function quen_mat_khau(){
    	$cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }     
    	return view('pages.checkout.forgot_password')->with(compact('count_cart'));
    }
    public function recover_password_customer(Request $request){
    	$data = $request->all();
    	$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
    	$title_mail = "Siêu Thị Online Khôi phục mật khẩu ".' '.$now;
    	$customer = customer::where('customer_email','=',$data['email_account'])->get();

    	foreach ($customer as $key => $value) {
    		$customer_id = $value->customer_id;
    		$customer_name = $value->customer_name;
     	}

    	if ($customer) {
    		$count_customer = $customer->count();
    		if ($count_customer==0) {
    			return Redirect()->back()->with('Error','Email không chính xác');
    		}else{
    			$token_random = Str::random();
    			$customer = customer::find($customer_id);
    			$customer->customer_token = $token_random;
    			$customer->save();

    			$to_email = $data['email_account'];
    			$link_reset_pass = url('/update-new-password-customer?email='.$to_email.'&token='.$token_random);

    			$data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account'],"name_customer"=>$customer_name);

    			Mail::send('pages.checkout.forgot_password_notify',['data'=>$data],function($message) use ($title_mail,$data){
    					$message->to($data['email'])->subject($title_mail);
    					$message->from($data['email'],$title_mail);
    			});
    			return Redirect()->back()->with('message','Gửi yêu cầu thành công, vui lòng vào Mail của bạn để để xác nhận khôi phục mật khẩu');
    		}
    	}
    }

    public function update_new_password_customer(){
    	return view('pages.checkout.new_password_customer');
    }

    public function reset_new_password_customer(Request $request){
    	$rules=[
		  'new_password_customer' => 'required|min:6|max:20',
		  'new_password_confirm_customer' => 'required|same:new_password_customer',
    ];

    $message=[
		  'new_password_customer.required' => 'Bạn chưa nhập mật khẩu mới !',
		  'new_password_customer.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự !',
		  'new_password_customer.max' => 'Mật khẩu không được lớn hơn 20 ký tự !',

		  'new_password_confirm_customer.required' => 'Bạn chưa nhập xác nhận mật khẩu !',
  		  'new_password_confirm_customer.same' => 'Mật khẩu xác nhận không chính xác !',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{
    	$data = $request->all();
    	$token_random = Str::random();
    	$customer = customer::where('customer_email','=',$data['email'])->where('customer_token',$data['token'])->get();
    	$count = $customer->count();
    	if ($count>0) {
    		foreach ($customer as $key => $value) {
    			$customer_id = $value->customer_id;
    		}
    		$reset = customer::find($customer_id);
    		$reset->customer_password = md5($data['new_password_customer']);
    		$reset->customer_token = $token_random;
    		$reset->save();
    		return view('pages.checkout.reset_password_success');
    	}else{
    		return Redirect()->back()->with('Error','Cập nhập mật khẩu thất bại, đường dẫn đã quá hạn bạn vui lòng gửi lại Email');
    	}
    }
}
}
