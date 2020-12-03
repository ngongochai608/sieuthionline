<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\roles;
use App\Models\admin;
use App\Models\product;
use App\Models\shipping;
use App\Models\shop;
use App\Models\customer;
use App\Models\order;

use Auth;

class AdminController extends Controller
{
	public function AuthLogin(){
		$admin_id = Auth::id();
		if($admin_id) {
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('admin')->send();
		}
	}

    public function index(){
    	return view('admin_login');
    }

    public function show_dashboard(){
    	$this->AuthLogin();
    	$count_product = product::count();
    	$count_shipping = shipping::count();
    	$count_shop = shop::count();
    	$count_customer = customer::count();
        $order_new = order::where('order_status','1')->orderby('create_at','DESC')->get();
    	return view('admin.dashboard')->with(compact('count_product','count_shipping','count_shop','count_customer','order_new'));
    }
}
