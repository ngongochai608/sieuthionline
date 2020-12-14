<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;

class CustomerController extends Controller
{
  public function AuthLogin(){
    $admin_id = Auth::id();
    if($admin_id) {
     return Redirect::to('dashboard');
   }else{
     return Redirect::to('admin')->send();
   }
 }
 public function add_customer(){
  $this->AuthLogin();
  return view('admin.customer.add_customer');
}
public function all_customer(){
  $this->AuthLogin();
  $customer = customer::all();
  return view('admin.customer.all_customer')->with('customer',$customer);
}
public function edit_customer($customer_id){
  $this->AuthLogin();
  $customer = customer::where('customer_id',$customer_id)->get();
  return view('admin.customer.edit_customer')->with('customer',$customer);
}   
public function delete_customer($customer_id){
  $this->AuthLogin();
  customer::where('customer_id',$customer_id)->delete();
  return Redirect::to('all-customer-admin')->with('message','Đã xóa tài khoản customer thành công !');
}
public function save_customer(Request $request){
 $rules=[
  'name_customer' => 'required|min:6|max:40',
  'email_customer' => 'required|email|unique:tbl_customer,customer_email|unique:tbl_shop,shop_email|unique:tbl_admin,admin_email',
  'phone_customer' => 'required|regex:/(0)[0-9]{9}/|max:10',
  'password_customer' => 'required|min:6|max:20',
  'password_customer_confirm' => 'required|same:password_customer',
  'address_customer' => 'required|max:150',
  'sex_customer' => 'required',
];
$messages = [
  'name_customer.required' => 'Họ tên không được để trống !',
  'name_customer.min' => 'Họ tên không được ít hơn 6 ký tự !',
  'name_customer.max' => 'Họ tên không được nhiều hơn 40 ký tự !',

  'email_customer.required' => 'Email không được để trống !',
  'email_customer.email' => 'Email không hợp lệ !',
  'email_customer.unique' => 'Email này đã tồn tại trong hệ thống!',

  'phone_customer.required' => 'Số điện thoại không được để trống !',
  'phone_customer.regex' => 'Số điện thoại không hợp lệ , số điện thoại phải là ký tự số bắt đầu bằng 0 và theo sao là 9 chữ số !',
  'phone_customer.max' => 'Số điện thoại không không được vượt quá 10 số !',

  'password_customer.required' => 'Mật khẩu không được để trống !',
  'password_customer.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự !',
  'password_customer.max' => 'Mật khẩu không được lớn hơn 20 ký tự !',

  'password_customer_confirm.required' => 'Nhập lại mật khẩu không được để trống !',
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
  $customer->customer_status = 1;
  $customer->save();
  return Redirect('add-customer-admin')->with('message','Đăng ký tài khoản khách hàng thành công !');
}        
}

public function update_customer(Request $request,$customer_id){
  $this->AuthLogin();
  $rules=[
    'name_customer' => 'required|min:6|max:40',
    'phone_customer' => 'required|numeric',
    'password_customer' => 'required|min:6|max:20',
    'password_customer_confirm' => 'required|same:password_customer',
  ];
  $messages = [
            //name
    'name_customer.required' => 'Trường họ tên không được để trống !',
    'name_customer.min' => 'Trường họ tên không được ít hơn 6 ký tự !',
    'name_customer.max' => 'Trường họ tên không được nhiều hơn 40 ký tự !',
            //phone
    'phone_customer.required' => 'Trường số điện thoại không được để trống !',
    'phone_customer.numeric' => 'Trường số điện thoại không hợp lệ ,số điện thoại phải là ký tự số !',
            //password
    'password_customer.required' => 'Trường mật khẩu không được để trống !',
    'password_customer.min' => 'Trường mật khẩu không được ít hơn 6 ký tự !',
    'password_customer.max' => 'Trường mật khẩu không được vượt quá 20 ký tự !',

    'password_customer_confirm.required' => 'Bạn chưa nhập xác nhận mật khẩu !',
    'password_customer_confirm.same' => 'Mật khẩu xác nhận không chính xác !',
  ];

  $validator = Validator::make($request->all(),$rules,$messages);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }else{
    $data = $request->all();
    $customer = customer::find($customer_id);
    $customer->customer_name = $data['name_customer'];
    $customer->customer_phone = $data['phone_customer'];
    $customer->customer_password = md5($data['password_customer']);
    $customer->customer_address = $data['address_customer'];
    $customer->update();
    return Redirect::to('add-customer-admin')->with('message','Cập nhập tài khoản customer thành công!');
  }
}
}
