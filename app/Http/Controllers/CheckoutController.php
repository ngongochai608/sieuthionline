<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\customer;
use App\Models\order;
use App\Models\shop;
use Auth;
session_start();

class CheckoutController extends Controller
{
  public function AuthLogin(){
    $admin_id = Auth::id();
    if($admin_id) {
     return Redirect::to('dashboard');
   }else{
     return Redirect::to('admin')->send();
   }
 }

 public function order_customer(){
   $cart = Session::get('cart');
   if ($cart==true) {
    $count_cart = count($cart);
  }else{
    $count_cart=0;
  }   
  $order_customer = order::where('customer_id',Session::get('customer_id'))->join('tbl_order_details','tbl_order_details.order_code','=','tbl_order.order_code')->join('tbl_shop','tbl_shop.shop_id','=','tbl_order_details.shop_id')->get();
  return view('pages.customer.order_customer')->with(compact('order_customer','count_cart'));
}
public function LoginCustomer(){
 return view('pages.checkout.login_customer');
}

public function Login_Customer(Request $request){
  $rules=[
    'email_customer' => 'required|email',
    'password_customer' => 'required',
  ];
  $messages = [
    'email_customer.required' => 'Trường email không được để trống !',
    'email_customer.email' => 'Trường email không hợp lệ !',

    'password_customer.required' => 'Trường mật khẩu không được để trống !'
  ];

  $validator = Validator::make($request->all(),$rules,$messages);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }else{
    $email=$request->email_customer;
    $password=md5($request->password_customer);
    $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
    if ($result) {
      Session::put('customer_name',$result->customer_name);
      Session::put('customer_id',$result->customer_id);
      return redirect('/trangchu');
    }else{
      return redirect()->back()->with('message_error','Bạn nhập sai email hoặc mật khẩu , vui lòng nhập lại');
    }
  }
}

public function change_password_customer(){
  $cart = Session::get('cart');
  if ($cart==true) {
    $count_cart = count($cart);
  }else{
    $count_cart=0;
  }   
  return view('pages.checkout.change_password_customer')->with(compact('count_cart'));
}

public function change_password_cus(Request $request){
  $rules=[
    'password_old' => 'required',
    'password_new' => 'required',
    'password_new_confirm' => 'required|same:password_new',
  ];
  $messages = [
    'password_old.required' => 'Bạn chưa nhập vào trường mật khẩu hiện tại !',
    'password_new.required' => 'Bạn chưa nhập vào trường mật khẩu mới !',
    'password_new_confirm.required' => 'Bạn chưa nhập vào trường xác nhận mật khẩu mới ! !',
    'password_new_confirm.same' => 'Mật khẩu xác nhận không khớp với mật khẩu ở trên !',
  ];

  $validator = Validator::make($request->all(),$rules,$messages);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }else{
    $data = $request->all();
    $customer_id = Session::get('customer_id');
    $password_cus = customer::find($customer_id);
    if ($password_cus->customer_password==md5($data['password_old'])) {
      $password_cus->customer_password = md5($data['password_new']);
      $password_cus->update();
      return Redirect('change-password-customer')->with('message','Đổi mật khẩu tài khoản khách hàng thành công !');
    }
    return Redirect('change-password-customer')->with('message_error','Nhập mật khẩu hiện tại không chính xác !');
  }
}
public function RegisterCustomer(){
 return view('pages.checkout.register_customer');
}

public function SiginCustomer(Request $request){
 $rules=[
  'name_customer' => 'required|min:6|max:40',
  'email_customer' => 'required|email|unique:tbl_customer,customer_email|unique:tbl_shop,shop_email|unique:tbl_admin,admin_email',
  'phone_customer' => 'required|numeric',
  'phone_customer' => 'required|regex:/(0)[0-9]{9}/|max:10',
  'password_customer' => 'required|min:6|max:20',
  'address_customer' => 'required|max:150',
];
$messages = [
  'name_customer.required' => 'Trường họ tên không được để trống !',
  'name_customer.min' => 'Trường họ tên không được ít hơn 6 ký tự !',
  'name_customer.max' => 'Trường họ tên không được nhiều hơn 40 ký tự !',

  'email_customer.required' => 'Trường email không được để trống !',
  'email_customer.email' => 'Trường email không hợp lệ !',
  'email_customer.unique' => 'Email này đã tồn tại trong hệ thống!',

  'phone_customer.required' => 'Trường số điện thoại không được để trống !',
  'phone_customer.regex' => 'Số điện thoại không hợp lệ , số điện thoại phải là ký tự số bắt đầu bằng 0 và theo sao là 9 chữ số !',
  'phone_customer.max' => 'Số điện thoại không không được vượt quá 10 số !',

  'password_customer.required' => 'Trường mật khẩu không được để trống !',
  'password_customer.min' => 'Trường mật khẩu không được nhỏ hơn 6 ký tự !',
  'password_customer.max' => 'Trường mật khẩu không được lớn hơn 20 ký tự !',

  'password_customer_confirm.required' => 'Trường nhập lại mật khẩu không được để trống !',
  'password_customer_confirm.same' => 'Mật khẩu nhập không khớp với mật khẩu ở trên !',

  'address_customer.required' => 'Bạn chưa nhập địa chỉ !',
  'address_customer.max' => 'Địa chỉ không được vượt quá 150 ký tự !',
];

$validator = Validator::make($request->all(),$rules,$messages);
if ($validator->fails()) {
  return redirect()->back()->withErrors($validator)->withInput();
}else{
  $data = $request->all();
  $customer = new customer();
  $customer->customer_name = $data['name_customer'];
  $customer->customer_email = $data['email_customer'];
  $customer->customer_password = md5($data['password_customer']);
  $customer->customer_phone = $data['phone_customer'];
  $customer->customer_address = $data['address_customer'];
  $customer->save();
  return Redirect('register-customer')->with('message','Đăng ký tài khoản khách hàng thành công !');
}        
}
public function logout_customer(){
  Session::put('customer_name',null);
  Session::put('customer_id',null);
  return redirect('trangchu');
}

}
