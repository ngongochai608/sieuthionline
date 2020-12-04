<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\shop;
use App\Models\product;
use App\Models\category_product;
use App\Models\shipping;
use App\Models\order;
use App\Models\order_details;
use App\Models\gallery;
use App\Models\statistical;
use App\Models\rating;
use Carbon\Carbon;
use Auth;
use Session;
session_start();


class ShopController extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
       return Redirect::to('dashboard');
   }else{
       return Redirect::to('admin')->send();
   }
}

public function insert_rating_shop(Request $request){
    $data = $request->all();
    $rating = new rating();
    $rating->shop_id = $data['shop_id'];
    $rating->rating = $data['index'];
    $rating->customer_name = $data['customer_name'];
    $rating->save();
    $order_code_feedback = $data['feedback_id'];
    $code_feedback = order_details::find($order_code_feedback);
    $code_feedback->feedback = 1;
    $code_feedback->save();
    echo "done";
}



public function load_comment(Request $request){
    $shop_id = $request->shop_id;
    $rating_shop = rating::where('shop_id',$shop_id)->get();
    $output='';
    foreach ($rating_shop as $key => $rating_s) {
        $output.= '
        <div class="row">
        <div class="col-md-1">
        <img src="public/frontend/images/avatar_customer.png" width="100%" class="img-thumbnail">
        </div>
        <div class="col-md-11">
        <span class="text text-primary">'.$rating_s->customer_name.'<p style="color:black;">'.$rating_s->rating_date.'</p></span>
        <ul class="list-inline" title="Đánh giá sao">
                  ';
                  for($count=1;$count<=5;$count++){
                  if($count<=$rating_s->rating){
                  $color="#ffcc00";
                  }else{
                  $color="#ccc";
                  }
                  $output.= '
                  <li title="Đánh giá sao"
                  id="" 
                  data-index=""
                  data-product_id=""
                  data-rating=""
                  class="rating"
                  style="cursor: pointer;color:'.$color.';font-size: 20px;font-size: 15px;">
                  &#9733;
                  </li>';
                  }

                  $output.= '
              </ul>
        </div>
        </div>
        <p></p>
        ';
    }
    echo $output;
}

public function statistical_30_days(Request $request){
    $sub30days = carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $now = carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $get = statistical::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales,
            'quantity' => $val->quantity
        );
    }
    echo $data = json_encode($chart_data);
}

public function filter_by_date(Request $request){
    $data = $request->all();
    $from_date = $request->from_date;
    $to_date = $request->to_date;

    $get = statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales,
            'quantity' => $val->quantity
        );
    }
    echo $data = json_encode($chart_data);
}

public function dashboard_filter(Request $request){
    $data = $request->all();
    $dauthangnay = Carbon::now("Asia/Ho_Chi_Minh")->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now("Asia/Ho_Chi_Minh")->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now("Asia/Ho_Chi_Minh")->subMonth()->endOfMonth()->toDateString();

    $sub7days = Carbon::now("Asia/Ho_Chi_Minh")->subdays(7)->toDateString();
    $sub365days = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();

    $now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();

    if ($data['dashboard_value']=='7ngay') {
        $get = statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
    }else if($data['dashboard_value']=='thangtruoc'){
        $get = statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
    }else if($data['dashboard_value']=='thangnay'){
        $get = statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
    }else{
        $get = statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
    }

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales,
            'quantity' => $val->quantity
        );
    }
    echo $data = json_encode($chart_data);
}

public function index_sales(){
    return view('sales_login');
}

public function sales_dashboard(){
    $shop_id = Session::get('shop_id');
    $shop = shop::where('shop_id',$shop_id)->first();
    $count_product = product::where('shop_id',$shop_id)->count();
    $count_shipping = order_details::where('shop_id',$shop_id)->count();
    $order_new = order::where('order_status','1')->orderby('create_at','DESC')->get();
    $product_shop = product::where('shop_id',$shop_id)->get();
    $product_sold_count = 0;
    foreach ($product_shop as $key => $val) {
        $product_sold_count += $val->product_sold;
    }
    return view('sales.sales_dashboard')->with(compact('count_shipping','count_product','shop','product_sold_count'));
}

public function unactive_shop($shop_id){
    $this->AuthLogin();
    shop::where('shop_id',$shop_id)->update(['shop_status'=>2]);
    Session::put('message','Đã khóa tài khoản gian hàng');
    return Redirect::to('all-shop-admin');

}
public function active_shop($shop_id){
    $this->AuthLogin();
    shop::where('shop_id',$shop_id)->update(['shop_status'=>1]);
    Session::put('message','Đã kích hoạt tài khoản gian hàng');
    return Redirect::to('all-shop-admin');
}

public function change_password_shop(){
    $shop_id = Session::get('shop_id');
    $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    $cart = Session::get('cart');
    if ($cart==true) {
        $count_cart = count($cart);
    }else{
        $count_cart=0;
    }   
    return view('sales.account.change_password_shop')->with(compact('count_cart','order_new'));
}

public function change_password_sh(Request $request){
    $rules=[
        'password_shop_old' => 'required',
        'password_shop_new' => 'required|min:6|max:30',
        'password_shop_new_confirm' => 'required|same:password_shop_new',
    ];
    $messages = [
        'password_shop_old.required' => 'Bạn chưa nhập vào trường mật khẩu hiện tại !',
        'password_shop_new.required' => 'Bạn chưa nhập vào trường mật khẩu mới !',
        'password_shop_new.min' => 'Mật khẩu tối thiểu phải có 6 ký tự !',
        'password_shop_new.max' => 'Mật khẩu tối đa phải có 30 ký tự !',
        'password_shop_new_confirm.required' => 'Bạn chưa nhập vào trường xác nhận mật khẩu mới ! !',
        'password_shop_new_confirm.same' => 'Mật khẩu xác nhận không khớp với mật khẩu ở trên !',
    ];

    $validator = Validator::make($request->all(),$rules,$messages);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }else{
        $data = $request->all();
        $shop_id = Session::get('shop_id');
        $password_shop = shop::find($shop_id);
        if ($password_shop->shop_password==md5($data['password_shop_old'])) {
          $password_shop->shop_password = md5($data['password_shop_new']);
          $password_shop->update();
          return Redirect('change-password-shop')->with('message','Đổi mật khẩu tài khoản gian hàng thành công !');
      }
      return Redirect('change-password-shop')->with('message_error','Nhập mật khẩu hiện tại không chính xác !');
  }
}

public function order_shop(){
    $shop_id = Session::get('shop_id');
    $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    $order_shop = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')->join('tbl_shipping','tbl_shipping.shipping_id','tbl_order.shipping_id')->get();
    return view('sales.order.order_shop')->with(compact('order_shop','order_new'));
}
public function register_shop(){
    $cart = Session::get('cart');
    if ($cart==true) {
        $count_cart = count($cart);
    }else{
        $count_cart=0;
    }   
    return view('pages.shop.register_shop')->with(compact('count_cart'));
}
public function all_product_shop(){
    $shop_id = Session::get('shop_id');
    $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    $shop_product = product::orderby('product_id','desc')->where('shop_id',$shop_id)->get();
    return view('sales.product_sales.all_product_shop')->with(compact('shop_product','order_new'));
}
public function logout_shop(){
    Session::put('shop_id',null);
    Session::put('shop_name',null);
    Session::put('customer_id',null);
    Session::put('customer_name',null);
    return Redirect::to('sales');
}
public function chitietshop($shop_id){
    $cart = Session::get('cart');
    if ($cart==true) {
        $count_cart = count($cart);
    }else{
        $count_cart=0;
    }
    $product_shop = product::where('shop_id',$shop_id)->get();
    $shop = shop::where('shop_id',$shop_id)->first();
    $shop->shop_view = $shop->shop_view+1;
    $shop->update();
    $rating = rating::where('shop_id',$shop_id)->avg('rating');
    $rating = round($rating);
    $rating_count = rating::where('shop_id',$shop_id)->count();
    return view('pages.shop.all_product_shop')->with(compact('product_shop','shop','count_cart','rating','rating_count'));
}
public function save_shop(Request $request){
    $rules=[
        'shop_name' => 'required|min:6|max:40|unique:tbl_shop,shop_name',
        'shop_email' => 'required|email|unique:tbl_shop,shop_email|unique:tbl_customer,customer_email|unique:tbl_admin,admin_email',
        'shop_password' => 'required|min:6|max:30',
        'shop_password_confirm' => 'required|same:shop_password',
        'shop_address' => 'required|min:10|max:200',
        'shop_phone' => 'required|regex:/(0)[0-9]{9}/|max:10',
    ];
    $messages = [
            //name
        'shop_name.required' => 'Tên không được để trống !',
        'shop_name.min' => 'Tên không được ít hơn 6 ký tự !',
        'shop_name.max' => 'Tên không được nhiều hơn 40 ký tự !',
        'shop_name.unique' => 'Tên gian hàng này đã có người đặt , bạn vui lòng chọn tên khác !',

        'name_shop_owner.required' => 'Tên không được để trống !',
        'name_shop_owner.min' => 'Tên không được ít hơn 6 ký tự !',
        'name_shop_owner.max' => 'Tên không được nhiều hơn 40 ký tự !',
            //email
        'shop_email.required' => 'Trường email không được để trống !',
        'shop_email.email' => 'Trường email không hợp lệ !',
        'shop_email.unique' => 'Email này đã tồn tại trong hệ thống!',
            //address
        'shop_address.required' => 'Địa chỉ không được để trống !',
        'shop_address.min' => 'Địa chỉ không được ít hơn 30 ký tự !',
        'shop_address.max' => 'Địa chỉ không được nhiều hơn 200 ký tự !',
            //phone
        'shop_phone.required' => 'Số điện thoại không được để trống !',
        'shop_phone.regex' => 'Số điện thoại không hợp lệ , số điện thoại phải là ký tự số bắt đầu bằng 0 và theo sao là 9 chữ số !',
        'shop_phone.max' => 'Số điện thoại không không được vượt quá 10 số !',
            //password
        'shop_password.required' => 'Mật khẩu không được để trống !',
        'shop_password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự !',
        'shop_password.max' => 'Mật khẩu không được lớn hơn 30 ký tự !',

        'shop_password_confirm.required' => 'Trường nhập lại mật khẩu không được để trống !',
        'shop_password_confirm.same' => 'Mật khẩu nhập lại không khớp với mật khẩu ở trên !',
    ];

    $validator = Validator::make($request->all(),$rules,$messages);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }else{
       $data = $request->all();
       $shop = new shop();
       $shop->shop_name = $data['shop_name'];
       $shop->name_shop_owner = $data['name_shop_owner'];
       $shop->shop_email = $data['shop_email'];
       $shop->shop_password = md5($data['shop_password']);
       $shop->shop_address = $data['shop_address'];
       $shop->shop_phone = $data['shop_phone'];
       $shop->shop_status = 0;
       $shop->create_at = now();
       $shop->save();
       return Redirect::to('register-shop')->with('message','Đã đăng ký gian hàng, vui lòng chờ thông báo xét duyệt từ ban quản lý Siêu Thị Online thông qua điện thoại!');
   }
}
public function loginshop(Request $request){
    $rules=[
        'shop_email' => 'required|email',
        'shop_password' => 'required',
    ];
    $messages = [
        'shop_email.required' => 'Trường email không được để trống !',
        'shop_email.email' => 'Trường email không hợp lệ !',

        'shop_password.required' => 'Trường mật khẩu không được để trống !'
    ];

    $validator = Validator::make($request->all(),$rules,$messages);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }else{
       $shop_email = $request->shop_email;
       $shop_password = md5($request->shop_password);
       $result = shop::where('shop_email',$shop_email)->where('shop_password',$shop_password)->first();
       if ($result) {
        if ($result->shop_status==1) {
            $shop_id = $result->shop_id;
            $shop_name = $result->shop_name;
            Session::put('shop_id',$shop_id);
            Session::put('shop_name',$shop_name);
            return Redirect::to('sales-dashboard');
        }else if($result->shop_status==0){
            return Redirect()->back()->with('message_error','Tài khoản gian hàng của bạn đang chờ được duyệt, vui lòng chờ thông báo từ chúng tôi');
        }else if($result->shop_status==2){
            return Redirect()->back()->with('message_error','Chúng tôi rất tiếc, tài khoản gian hàng của bạn đã bị khóa');
        }
    }else{
      return Redirect()->back()->with('message_error','Bạn đã nhập sai email hoặc mật khẩu không chính xác vui lòng nhập lại');
  }
}
}

    //Backend
public function add_shop_admin(){
    $this->AuthLogin();
    return view('admin.shop.add_shop');
}

public function save_shop_admin(Request $request){
    $this->AuthLogin();
    $rules=[
        'shop_name' => 'required|min:6|max:40|unique:tbl_shop,shop_name',
        'name_shop_owner' => 'required|min:6|max:40',
        'shop_email' => 'required|email|unique:tbl_shop,shop_email|unique:tbl_customer,customer_email|unique:tbl_admin,admin_email',
        'shop_password' => 'required|min:6|max:30',
        'shop_password_confirm' => 'required|same:shop_password',
        'shop_address' => 'required|min:10|max:200',
        'shop_phone' => 'required|regex:/(0)[0-9]{9}/|max:10',
    ];
    $messages = [
            //name
        'shop_name.required' => 'Tên không được để trống !',
        'shop_name.min' => 'Tên không được ít hơn 6 ký tự !',
        'shop_name.max' => 'Tên không được nhiều hơn 40 ký tự !',
        'shop_name.unique' => 'Tên gian hàng này đã có người đặt , bạn vui lòng chọn tên khác !',
            //name shop awner
        'name_shop_owner.required' => 'Tên không được để trống !',
        'name_shop_owner.min' => 'Tên không được ít hơn 6 ký tự !',
        'name_shop_owner.max' => 'Tên không được nhiều hơn 40 ký tự !',
            //email
        'shop_email.required' => 'Trường email không được để trống !',
        'shop_email.email' => 'Trường email không hợp lệ !',
        'shop_email.unique' => 'Email này đã tồn tại !',
            //address
        'shop_address.required' => 'Địa chỉ không được để trống !',
        'shop_address.min' => 'Địa chỉ không được ít hơn 30 ký tự !',
        'shop_address.max' => 'Địa chỉ không được nhiều hơn 200 ký tự !',
            //phone
        'shop_phone.required' => 'Số điện thoại không được để trống !',
        'shop_phone.regex' => 'Số điện thoại không hợp lệ , số điện thoại phải là ký tự số bắt đầu bằng 0 và theo sao là 9 chữ số !',
        'shop_phone.max' => 'Số điện thoại không không được vượt quá 10 số !',
            //password
        'shop_password.required' => 'Mật khẩu không được để trống !',
        'shop_password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự !',
        'shop_password.max' => 'Mật khẩu không được lớn hơn 30 ký tự !',

        'shop_password_confirm.required' => 'Bạn chưa nhập mật khẩu xác thực!',
        'shop_password_confirm.same' => 'Mật khẩu xác nhận không chính xác !',
    ];

    $validator = Validator::make($request->all(),$rules,$messages);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }else{
        $data = $request->all();
        $shop = new shop();
        $shop->shop_name = $data['shop_name'];
        $shop->name_shop_owner = $data['name_shop_owner'];
        $shop->shop_email = $data['shop_email'];
        $shop->shop_password = md5($data['shop_password']);
        $shop->shop_address = $data['shop_address'];
        $shop->shop_phone = $data['shop_phone'];
        $shop->shop_status = 1;
        $shop->create_at = now();
        $shop->save();
        return Redirect::to('add-shop-admin')->with('message','Thêm gian hàng thành công !');
    }
}

public function all_shop_admin(){
    $this->AuthLogin();
    $all_shop = shop::where('shop_status','1')->get();
    return view('admin.shop.all_shop')->with(compact('all_shop'));
}

public function all_shop_wait_active(){
    $this->AuthLogin();
    $all_shop_wait = shop::where('shop_status','0')->get();
    return view('admin.shop.all_shop_wait_active')->with(compact('all_shop_wait'));
}

public function all_shop_block(){
    $this->AuthLogin();
    $all_shop_block = shop::where('shop_status','2')->get();
    return view('admin.shop.all_shop_block')->with(compact('all_shop_block'));
}

public function edit_shop_admin($shop_id){
    $this->AuthLogin();
    $shop = shop::where('shop_id',$shop_id)->get();
    return view('admin.shop.edit_shop')->with('shop',$shop);
}

public function update_shop_admin(Request $request,$shop_id){
    $this->AuthLogin();
    $rules=[
        'shop_password' => 'required|min:6|max:100',
        'shop_password_confirm' => 'required|same:shop_password',
    ];

    $message=[
        'shop_password.required' => 'Bạn chưa nhập mật khẩu',
        'shop_password.min' => 'Mật khẩu không được ít hơn 6 ký tự',
        'shop_password.max' => 'Mật khẩu không được nhiều hơn 100 ký tự',

        'shop_password_confirm.required' => 'Bạn chưa nhập mật khẩu xác nhận',
        'shop_password_confirm.same' => 'Bạn nhập mật khẩu xác nhận không chính xác',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{
        $data = $request->all();
        $shop = shop::find($shop_id);
        $shop->shop_password = md5($data['shop_password']);
        $shop->shop_phone = $data['shop_phone'];
        $shop->shop_address = $data['shop_address'];
        $shop->update();
        return Redirect::to('all-shop-admin')->with('message','Sửa thông tin gian hàng thành công !');
    }
}

public function delete_shop_admin($shop_id){
    $this->AuthLogin();
    shop::where('shop_id',$shop_id)->delete();
    return Redirect::to('all-shop-admin')->with('message','Xóa gian hàng thành công!');
}
public function add_product_shop(){
    $shop_id = Session::get('shop_id');
    $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    $category_product = category_product::orderby('category_id','desc')->get();
    return view('sales.product_sales.add_product_shop')->with(compact('category_product','order_new'));
}
public function post_product_shop(Request $request){
    $rules=[
        'product_name' => 'required|min:6|max:100',
        'product_quantity' => 'required|numeric',
        'product_desc' => 'required',
        'product_price' => 'required|numeric',
        'product_image' => 'required',
    ];

    $message=[
            //name
        'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
        'product_name.min' => 'Tên sản phẩm không được ít hơn 6 ký tự',
        'product_name.max' => 'Tên sản phẩm không được nhiều hơn 100 ký tự',
            //quantity
        'product_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        'product_quantity.numeric' => 'Số lượng sản phẩm phải được nhập bằng số',
            //desc
        'product_desc.required' => 'Bạn chưa nhập mô tả sản phẩm',
            //price
        'product_price.required' => 'Bạn chưa nhập giá sản phẩm',
        'product_price.numeric' => 'Giá sản phẩm phải được nhập bằng số',
            //image
        'product_image.required' => 'Bạn chưa chọn hình ảnh sản phẩm',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{

        $data = array();
        $product = new product();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['category_id'] = $request->category_id;
        $data['shop_id'] = $request->shop_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = 1;
        $data['product_sold'] = $request->product_sold;

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $get_image = $request->file('product_image');

        if($get_image){
            $new_image = rand(0,99).'.'.$get_image->getClientOriginalName();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $data['product_image'] = $new_image;   
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        Session::put('message','Thêm sản phẩm thành công, sản phẩm này đang chờ quản trị viên duyệt !');
        return Redirect::to('/add-product-shop');
    }
}
}
