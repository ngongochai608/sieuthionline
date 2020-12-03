<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment_shop;
use Illuminate\Support\Facades\Redirect;
use Auth;

class CommentController extends Controller
{
	 public function AuthLogin(){
      $admin_id = Auth::id();
      if($admin_id) {
         return Redirect::to('dashboard');
     }else{
         return Redirect::to('admin')->send();
     }
 }

    public function all_comment_shop_admin(){
    	$this->AuthLogin();
    	$comment_shop_wait = comment_shop::where('comment_shop_status',1)->get();
    	return view('admin.comment.comment_shop')->with(compact('comment_shop_wait'));
    }

    public function active_comment_shop_admin($comment_shop_id){
    	$this->AuthLogin();
    	comment_shop::where('comment_shop_id',$comment_shop_id)->update(['comment_shop_status'=>0]);
    	return Redirect::to('all-comment-shop-admin')->with('message','Đã duyệt đánh giá thành công');
    }

    public function delete_comment_shop_admin($comment_shop_id){
    	$this->AuthLogin();
    	$comment_shop = comment_shop::find($comment_shop_id);
    	$comment_shop->delete();
    	return Redirect::to('all-comment-shop-admin')->with('message','Đã xóa đánh giá thành công');
    }
}
