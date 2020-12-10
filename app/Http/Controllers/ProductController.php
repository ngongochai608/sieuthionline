<?php

namespace App\Http\Controllers;

use Session;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\shop;
use App\Models\product;
use App\Models\category_product;
use App\Models\order;
use App\Models\order_details;
use App\Models\gallery;
use App\Models\comment_product;
use Auth;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
     }else{
         return Redirect::to('admin')->send();
     }
 }
 public function CheckLoginShop(){
        $shop_id = Session::get('shop_id');
        if($shop_id) {
         return Redirect::to('sales-dashboard');
     }else{
         return Redirect::to('sales')->send();
     }
 }

 public function send_comment_product(Request $request){
    $data = $request->all();
    $comment_product = new comment_product();
    $comment_product->comment_name = $data['comment_name'];
    $comment_product->comment_content = $data['comment_content'];
    $comment_product->product_id = $data['product_id'];
    $comment_product->save();

    $order_details_id = $data['order_details_id'];
    $order_details_id = order_details::find($order_details_id);
    $order_details_id->comment_product = 1;
    $order_details_id->save();
}

public function unactive_product($product_id){
    $this->AuthLogin();
    product::where('product_id',$product_id)->update(['product_status'=>3]);
    Session::put('message','Đã ẩn sản phẩm thành công');
    return Redirect::to('all-product-admin');

}
public function active_product($product_id){
    $this->AuthLogin();
    product::where('product_id',$product_id)->update(['product_status'=>0]);
    Session::put('message','Đã duyệt sản phẩm thành công!');
    return Redirect::to('all-product-admin');
}

 public function allproduct(){
     return view('pages.product.allproduct');
 }

 public function chitietsanpham($product_slug,$shop_id,$category_id){
    $category = $category_id;
    $cart = Session::get('cart');
    if ($cart==true) {
        $count_cart = count($cart);
    }else{
        $count_cart=0;
    }  
    $shop_id_ss = Session::get('shop_id');
    $order_new = order_details::where('shop_id',$shop_id_ss)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
    $product_chitiet = product::where('product_slug',$product_slug)->first();
    $product_chitiet->product_view = $product_chitiet->product_view+1;
    $product_chitiet->update();
    $product_relate = product::orderBy('product_sold','DESC')->where('category_id',$category_id)->take(10)->whereNotIn('tbl_product.product_slug',[$product_slug])->get();
    $related_product = product::orderBy('product_id','desc')->get();
    $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_id',$category_id)->first();
    $shop = shop::where('shop_id',$shop_id)->first();
    $product_id = $product_chitiet->product_id;
    //gallery
    $gallery = gallery::where('product_id',$product_id)->get();
    $comment_product = comment_product::where('product_id',$product_id)->get();
    return view('pages.product.singleproduct')->with(compact('product_chitiet','related_product','shop','category_by_id','order_new','count_cart','product_relate','gallery','category','comment_product'));
}

public function all_product_admin(){
    $this->AuthLogin();
    $product = product::orderBy('product_id','desc')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->join('tbl_shop','tbl_shop.shop_id','=','tbl_product.shop_id')->get();
    return view('admin.product.all_product')->with('product',$product);
}

public function add_product_admin(){
    $this->AuthLogin();
    $category_product = category_product::orderBy('category_id','desc')->get();
    return view('admin.product.add_product')->with('category_product',$category_product);
}

public function save_product_admin(Request $request){
    $this->AuthLogin();
    $rules=[
        'product_name' => 'required|min:15|max:40',
        'product_slug' => 'required',
        'product_quantity' => 'required|numeric',
        'product_desc' => 'required',
        'product_price' => 'required|numeric',
        'product_image' => 'required|dimensions:min_width=300,min_height=500',
    ];

    $message=[
        'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
        'product_name.min' => 'Tên sản phẩm không được ít hơn 15 ký tự',
        'product_slug.max' => 'Tên sản phẩm không được nhiều hơn 40 ký tự',

        'product_name.required' => 'Bạn chưa nhập slug cho sản phẩm',

        'product_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        'product_quantity.numeric' => 'Số lượng sản phẩm phải được nhập bằng số',

        'product_desc.required' => 'Bạn chưa nhập mô tả sản phẩm',

        'product_price.required' => 'Bạn chưa nhập giá sản phẩm',
        'product_price.numeric' => 'Giá sản phẩm phải được nhập bằng số',

        'product_image.required' => 'Bạn chưa chọn hình ảnh sản phẩm',
        'product_image.dimensions' => 'Không được chọn ảnh có chiều ngang nhỏ hơn 300px và chiều cao nhỏ hơn 500px',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['category_id'] = $request->category_id;
        $data['shop_id'] = $request->shop_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['product_sold'] = 0;

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
        Session::put('message','Thêm sản phẩm thành công !');
        return Redirect::to('/add-product-admin');      

    }
}

public function edit_product_admin($product_id){
    $this->AuthLogin();
    $category_product = category_product::orderBy('category_id','desc')->get();
    $edit_product = product::where('product_id',$product_id)->get();
    return view('admin.product.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product);
}
public function update_product_admin(Request $request,$product_id){
    $this->AuthLogin();
    $rules=[
        'product_name' => 'required|min:15|max:40',
        'product_quantity' => 'required|numeric',
        'product_desc' => 'required',
        'product_price' => 'required|numeric',
    ];

    $message=[
        'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
        'product_name.min' => 'Tên sản phẩm không được ít hơn 15 ký tự',
        'product_name.max' => 'Tên sản phẩm không được nhiều hơn 40 ký tự',

        'product_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        'product_quantity.numeric' => 'Số lượng sản phẩm phải được nhập bằng số',

        'product_desc.required' => 'Bạn chưa nhập mô tả sản phẩm',

        'product_price.required' => 'Bạn chưa nhập giá sản phẩm',
        'product_price.numeric' => 'Giá sản phẩm phải được nhập bằng số',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{$data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['shop_id'] = $request->shop_id;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->category_id;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product-admin');
        }
    }

    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    Session::put('message','Cập nhật sản phẩm thành công');
    return Redirect::to('all-product-admin');
}
public function edit_product_shop($product_id){
    $this->CheckLoginShop();
    $category_product = category_product::orderBy('category_id','desc')->get();
    $edit_product = product::where('product_id',$product_id)->first();
    return view('sales.product_sales.edit_product_shop')->with('edit_product',$edit_product)->with('category_product',$category_product);
}
public function update_product_shop(Request $request,$product_id){
    $rules=[
        'product_name' => 'required|min:15|max:40',
        'product_quantity' => 'required|numeric',
        'product_desc' => 'required',
        'product_price' => 'required|numeric',
    ];

    $message=[
        'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
        'product_name.min' => 'Tên sản phẩm không được ít hơn 15 ký tự',
        'product_name.max' => 'Tên sản phẩm không được nhiều hơn 40 ký tự',

        'product_quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
        'product_quantity.numeric' => 'Số lượng sản phẩm phải được nhập bằng số',

        'product_desc.required' => 'Bạn chưa nhập mô tả sản phẩm',

        'product_price.required' => 'Bạn chưa nhập giá sản phẩm',
        'product_price.numeric' => 'Giá sản phẩm phải được nhập bằng số',
    ];

    $validator = Validator::make($request->all(),$rules,$message);
    if ($validator->fails()) {
        return Redirect()->back()->withErrors($validator)->withInput();
    }else{$data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['shop_id'] = $request->shop_id;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->category_id;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product-shop');
        }
    }

    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    Session::put('message','Cập nhật sản phẩm thành công');
    return Redirect::to('all-product-shop');
}



public function delete_product_admin($product_id){
    $this->AuthLogin();
    product::where('product_id',$product_id)->delete();
    return Redirect::to('all-product-admin')->with('message','Đã xóa sản phẩm thành công !');
}

public function delete_product_shop($product_id){
    product::where('product_id',$product_id)->delete();
    return Redirect::to('all-product-shop')->with('message','Đã xóa sản phẩm thành công !');
}
}
