<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\customer;
use App\Models\order;
use App\Models\order_details;
use App\Models\shop;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
session_start();

class CheckoutController extends Controller
{
  public function CheckLoginCustomer(){
    $customer_id = Session::get('customer_id');
    if($customer_id) {
     return Redirect::to('customer_id');
   }else{
     return Redirect::to('/')->send();
   }
 }

 public function AuthLogin(){
  $admin_id = Auth::id();
  if($admin_id) {
   return Redirect::to('dashboard');
 }else{
   return Redirect::to('admin')->send();
 }
}

public function order_customer(){
  $this->CheckLoginCustomer();
  $cart = Session::get('cart');
  if ($cart==true) {
    $count_cart = count($cart);
  }else{
    $count_cart=0;
  }
  $order_count = order::where('customer_id',Session::get('customer_id'))->count();   
  $order_customer = order::where('customer_id',Session::get('customer_id'))->paginate(5);
  return view('pages.customer.order_customer')->with(compact('order_customer','count_cart','order_count'));
}
public function LoginCustomer(){
 return view('pages.checkout.login_customer');
}

public function order_details_customer($order_code){
 $cart = Session::get('cart');
 if ($cart==true) {
  $count_cart = count($cart);
}else{
  $count_cart=0;
}   
$order_details_customer = order_details::where('order_code',$order_code)->join('tbl_shop','tbl_order_details.shop_id','=','tbl_shop.shop_id')->get();
$order_customer = order::where('order_code',$order_code)->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')->first();
if ($order_customer==NULL) {
  return Redirect('/')->with(compact('count_cart'));
}
$order_code_d = $order_code;
return view('pages.customer.order_details_customer')->with(compact('order_details_customer','count_cart','order_customer','order_code_d'));
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
      if ($result->customer_status!=0) {
        Session::put('customer_name',$result->customer_name);
        Session::put('customer_id',$result->customer_id);
        return redirect('/trangchu');
      }else{
        return redirect()->back()->with('message_error','Tài khoản của bạn chưa được xác thực , vui lòng vào email của bạn để xác thực đăng ký');
      }
      
    }else{
      return redirect()->back()->with('message_error','Bạn nhập sai email hoặc mật khẩu , vui lòng nhập lại');
    }
  }
}

public function change_password_customer(){
  $this->CheckLoginCustomer();
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
  'sex_customer' => 'required',
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

  'sex_customer.required' => 'Bạn chưa chọn giới tính !',
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
  $customer->customer_sex = $data['sex_customer'];
  $customer->customer_status = 0;
  $customer->save();

  $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
  $title_mail = "Siêu Thị Online xác nhận tài khoản ".' '.$now;
  $customer_mail = customer::where('customer_email','=',$data['email_customer'])->get();

  foreach ($customer_mail as $key => $value) {
        $customer_id = $value->customer_id;
        $customer_name = $value->customer_name;
      }

  if ($customer_mail) {
          $token_random = Str::random();
          $customer_1 = customer::find($customer_id);
          $customer_1->customer_token = $token_random;
          $customer_1->save();

          $to_email = $data['email_customer'];
          $link_access_account = url('/access-account-notify?email='.$to_email.'&token='.$token_random);

          $data = array("name"=>$title_mail,"body"=>$link_access_account,"email"=>$data['email_customer'],"name_customer"=>$customer_name);

          Mail::send('pages.checkout.access_account_customer',['data'=>$data],function($message) use ($title_mail,$data){
              $message->to($data['email'])->subject($title_mail);
              $message->from($data['email'],$title_mail);
          });
          return Redirect()->back()->with('message','Đăng ký tài khoản khách hàng thành công, vui lòng vào email để xác nhận đăng ký');
        
      }
}        
}
public function access_customer(Request $request){
    $data = $request->all();
    $customer_email = $data['email_customer'];
    $customer = customer::where('customer_email', $customer_email)->where('customer_token',$data['token_customer'])->first();
    $customer->customer_status = 1;
    $customer->save();
    return Redirect('login-customer')->with('message','Tài khoản của bạn đã được xác thực thành công');
}

public function access_account_notify(){
    return view('pages.checkout.access_account_notify');
}
public function logout_customer(){
  Session::put('customer_name',null);
  Session::put('customer_id',null);
  return redirect('trangchu');
}

}
