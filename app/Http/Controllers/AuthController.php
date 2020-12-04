<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\admin;
use App\Models\roles;
use Auth;

class AuthController extends Controller
{
   public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
      }else{
         return Redirect::to('admin')->send();
      }
   }

   public function change_password_admin(){
      return view('admin.auth.change_password_admin');
   }

   public function change_password_admin_form(Request $request){
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
     $admin_id = Auth::id();;
     $password_admin = admin::find($admin_id);
     if ($password_admin->admin_password==md5($data['password_old'])) {
      $password_admin->admin_password = md5($data['password_new']);
      $password_admin->update();
      return Redirect('change-password-admin')->with('message','Đổi mật khẩu tài khoản thành công !');
   }
   return Redirect('change-password-admin')->with('message_error','Nhập mật khẩu hiện tại không chính xác !');
}
}

public function delete_user_roles($admin_id){
   if (Auth::id()==$admin_id) {
      return Redirect::back()->with('message_error','Bạn không được quyền xóa chính mình');
   }
   $admin = admin::find($admin_id);
   if ($admin) {
      $admin->roles()->detach();
      $admin->delete();
   }      
   return Redirect::back()->with('message','Xóa user thành công!');
}

public function add_user(){
   $this->AuthLogin();
   return view('admin.users.add_user');
}

public function save_user(Request $request){
   $rules=[
      'admin_name' => 'required|min:6|max:40',
      'admin_email' => 'required|email|unique:tbl_admin,admin_email',
      'admin_phone' => 'required|regex:/(0)[0-9]{9}/|max:10',
      'admin_password' => 'required|min:6|max:16',
      'admin_password_confirm' => 'required|same:admin_password',
   ];
   $messages = [
            //name
      'admin_name.required' => 'Trường họ tên không được để trống !',
      'admin_name.min' => 'Trường họ tên không được ít hơn 6 ký tự !',
      'admin_name.max' => 'Trường họ tên không được nhiều hơn 40 ký tự !',
            //email
      'admin_email.required' => 'Trường email không được để trống !',
      'admin_email.email' => 'Trường email không hợp lệ !',
      'admin_email.unique' => 'Email này đã tồn tại !',
            //phone
      'admin_phone.required' => 'Trường số điện thoại không được để trống !',
      'admin_phone.regex' => 'Số điện thoại không hợp lệ , số điện thoại phải là ký tự số bắt đầu bằng 0 và theo sao là 9 chữ số !',
      'admin_phone.max' => 'Số điện thoại không không được vượt quá 10 số !',
            //password
      'admin_password.required' => 'Trường mật khẩu không được để trống !',
      'admin_password.min' => 'Trường mật khẩu không được nhỏ hơn 6 ký tự !',
      'admin_password.max' => 'Trường mật khẩu không được lớn hơn 16 ký tự !',

      'admin_password_confirm.required' => 'Bạn chưa nhập xác nhận mật khẩu !',
      'admin_password_confirm.same' => 'Mật khẩu xác nhận không chính xác !',
   ];
   $validator = Validator::make($request->all(),$rules,$messages);
   if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
   }else{
      $data = $request->all();
      $admin = new admin();
      $admin->admin_name = $data['admin_name'];
      $admin->admin_email = $data['admin_email'];
      $admin->admin_phone = $data['admin_phone'];
      $admin->admin_address = $data['admin_address'];
      $admin->admin_password = md5($data['admin_password']);
      $admin->save();
      return redirect('add-user')->with('message','Thêm tài khoản quản trị viên thành công !');
   }
}

public function login_admin(){
   return view('admin_login');
}

public function logout_admin(){
   Auth::logout();
   return Redirect('/admin');
}

public function login(Request $request){
   $rules=[
      'admin_email' => 'required|email',
      'admin_password' => 'required',
   ];
   $messages=[
      'admin_email.required' => 'Chưa nhập vào trường email',
      'admin_email.email' => 'Email không hợp lệ',
      'admin_password.required' => 'Chưa nhập vào trường mật khẩu',
   ];

   $validator = Validator::make($request->all(),$rules,$messages);
   if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
   }else{
      if (Auth::attempt(['admin_email'=>$request->admin_email,'admin_password'=>$request->admin_password])) {
         return Redirect('/dashboard');
      }else{               
         return Redirect('admin')->with('message','Email hoặc mật khẩu không đúng !');
      }
   }         
}
}
