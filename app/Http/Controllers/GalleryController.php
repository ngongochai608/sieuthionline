<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\product;
use App\Models\gallery;
use App\Models\order;
use App\Models\order_details;
use Auth;
session_start();

class GalleryController extends Controller
{
	public function AuthLogin(){
		$admin_id = Auth::id();
		if($admin_id) {
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('admin')->send();
		}
	}

	public function add_gallery_product_shop($product_id){
		$pro_id = $product_id;
		$shop_id_ss = Session::get('shop_id');
		$order_new = order_details::where('shop_id',$shop_id_ss)->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')->where('order_status',1)->count();
		return view('sales.gallery.add_gallery_shop_product')->with(compact('pro_id','order_new','shop_id_ss'));
	}

	public function insert_gallery(Request $request,$pro_id){
		$get_image = $request->file('file');

		if($get_image){
			foreach ($get_image as $image) {
				$get_name_image = $image->getClientOriginalName();
				$name_image = current(explode('.',$get_name_image));
				$new_image =  $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
				$image->move('public/uploads/gallery',$new_image);
				$gallery = new gallery();
				$gallery->gallery_name = $new_image;
				$gallery->gallery_image = $new_image;
				$gallery->product_id = $pro_id;
				$gallery->save();
			}
		}
		Session::put('message','Thêm thư viện ảnh thành công');
		return Redirect()->back();
	}

	public function update_gallery_name(Request $request){
		$gal_id = $request->gal_id;
		$gal_text = $request->gal_text;
		$gallery = gallery::find($gal_id);
		$gallery->gallery_name = $gal_text;
		$gallery->save();
	}

	public function delete_gallery(Request $request){
		$gal_id = $request->gal_id;
		$gallery = gallery::find($gal_id);
		unlink('public/uploads/gallery/'.$gallery->gallery_image);
		$gallery->delete();
	}

	public function update_gallery(Request $request){
		$get_image = $request->file('file');
		$gal_id = $request->gal_id;
		if($get_image){
			$get_name_image = $get_image->getClientOriginalName();
			$name_image = current(explode('.',$get_name_image));
			$new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
			$get_image->move('public/uploads/gallery',$new_image);
			$gallery = gallery::find($gal_id);
			unlink('public/uploads/gallery/'.$gallery->gallery_image);
			$gallery->gallery_image = $new_image;
			$gallery->save();
		}
	}

	public function select_gallery(Request $request){
		$product_id = $request->pro_id;
		$gallery = gallery::where('product_id',$product_id)->get();
		$gallery_count = $gallery->count();
		$output = '
		<form>
		'.csrf_field().'
		<table class="table table-hover">
		<thead>
		<tr>
		<th>STT</th>
		<th>Tên hình ảnh</th>
		<th>Hình ảnh</th>
		<th>Quản lý</th>
		</tr>
		</thead>
		<tbody>
		';
		if ($gallery_count>0) {
			$i=0;
			foreach ($gallery as $key => $val_gallery) {
				$i++;
				$output.='
				<tr>
				<td>'.$i.'</td>
				<td contenteditable class="edit_gallery_name" data-gal_id="'.$val_gallery->gallery_id.'";>'.$val_gallery->gallery_name.'</td>
				<td>
				<img src="public/uploads/gallery/'.$val_gallery->gallery_image.'" height="100" width="100" class="img-thumbnail"><br/>
				<input type="file" class="file_image" style="width:40%;" data-gal_id="'.$val_gallery->gallery_id.'"; id="file-'.$val_gallery->gallery_id.'"  name="file" accept="image/*" />
				</td>
				<td>
				<button type="button" data-gal_id="'.$val_gallery->gallery_id.'"; class="btn btn-danger btn-sm delete-gallery" class="btn btn-danger">Xóa</button>
				</td>
				</tr>
				
				';
			}
		}else{
			$output.='
			<tr>
			<td colspan="4">Sản phẩm này chưa có thư viện ảnh Gallery</td>
			</tr>
			';
		}
		$output.='
		</tbody>
		</table>
		</form>
		';
		echo $output;
	}
}
