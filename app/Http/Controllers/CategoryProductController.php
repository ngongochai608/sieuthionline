<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use App\Models\category_product;
use App\Models\order;
use App\Models\order_details;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
session_start();


class CategoryProductController extends Controller
{
    public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
      }else{
         return Redirect::to('admin')->send();
      }
    }
    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.category_product.add_category_product');
    }

    public function edit_category_product($category_id){
        $this->AuthLogin();
        $category_product = category_product::where('category_id',$category_id)->get();
        return view('admin.category_product.edit_category_product')->with('category_product',$category_product);
    }

    public function delete_category_product($category_id){
        $this->AuthLogin();
        category_product::where('category_id',$category_id)->delete();
        return Redirect::to('/all-category-product-admin')->with('message','Xóa danh mục sản phẩm thành công!');
    }
    public function show_category($category_slug){
        $cart = Session::get('cart');
        if ($cart==true) {
            $count_cart = count($cart);
        }else{
            $count_cart=0;
        }
        $shop_id = Session::get('shop_id');
        $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
        $name_category = category_product::where('category_slug_product',$category_slug)->first();
        $category_by_slug = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_slug_product',$category_slug)->paginate(20);
        return view('pages.category_product.show_category_product')->with(compact('category_by_slug','name_category','order_new','count_cart'));
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$rules=[
            'category_product_name' => 'required|min:2|max:50|unique:tbl_category_product,category_name',
            'category_product_desc' => 'required',
            'category_product_image' => 'required',
        ];

        $message=[
            //name
            'category_product_name.required' => 'Bạn chưa nhập tên danh mục sản phẩm',
            'category_product_name.min' => 'Tên danh mục sản phẩm không được ít hơn 2 ký tự',
            'category_product_name.unique' => 'Tên danh mục sản phẩm này đã tồn tại',
            'category_product_name.max' => 'Tên danh mục sản phẩm không được nhiều hơn 50 ký tự',
            //quantity
            'category_product_desc.required' => 'Bạn chưa nhập mô tả danh mục sản phẩm',
            'category_product_image.required' => 'Bạn chưa chọn hình ảnh cho danh mục sản phẩm',
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        }else{
            $data = array();
            $data['category_name'] = $request->category_product_name;
            $data['category_slug_product'] = $request->category_product_slug;
            $data['category_desc'] = $request->category_product_desc;

            $path = 'public/uploads/category_product/';
            $get_image = $request->file('category_product_image');

            if($get_image){
                $new_image = rand(0,99).'.'.$get_image->getClientOriginalName();
                $get_image->move('public/uploads/category_product',$new_image);
                $data['category_image'] = $new_image;
                DB::table('tbl_category_product')->insert($data);
                Session::put('message','Thêm danh mục sản phẩm thành công !');
                return Redirect::to('/add-category-product-admin');         
            }
            $data['category_image'] = '';
            DB::table('tbl_category_product')->insert($data);
            return Redirect::to('/add-category-product-admin')->with('message','Thêm danh mục sản phẩm thành công !');
        }
    }
    
    public function all_category_product(){
            $this->AuthLogin();
            $shop_id = Session::get('shop_id');
            $order_new = order_details::where('shop_id',$shop_id)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
            $category_product = category_product::orderby('category_id','desc')->get();
            return view('admin.category_product.all_category_product')->with(compact('category_product','order_new'));
    }

    public function update_category_product(Request $request,$category_id){
        $this->AuthLogin();
        $rules=[
            'category_product_name' => 'required|min:2|max:50',
            'category_product_desc' => 'required',
        ];

        $message=[
            //name
            'category_product_name.required' => 'Bạn chưa nhập tên danh mục sản phẩm',
            'category_product_name.min' => 'Tên danh mục sản phẩm không được ít hơn 2 ký tự',
            'category_product_name.max' => 'Tên danh mục sản phẩm không được nhiều hơn 50 ký tự',
            //quantity
            'category_product_desc.required' => 'Bạn chưa nhập mô tả danh mục sản phẩm',
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        }else{
            $data = array();
            $data['category_name'] = $request->category_product_name;
            $data['category_slug_product'] = $request->category_product_slug;
            $data['category_desc'] = $request->category_product_desc;

            $path = 'public/uploads/category_product/';
            $get_image = $request->file('category_product_image');

            if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/category_product',$new_image);
            $data['category_product_image'] = $new_image;
            DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
            Session::put('message','Cập nhật danh mục sản phẩm thành công');
            return Redirect::to('all-category-product-admin');   
            }
            DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
            Session::put('message','Cập nhật danh mục sản phẩm thành công');
            return Redirect::to('all-category-product-admin');
        }
    }
}
