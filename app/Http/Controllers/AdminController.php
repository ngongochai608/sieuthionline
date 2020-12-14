<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\roles;
use App\Models\admin;
use App\Models\admin_roles;
use App\Models\product;
use App\Models\category_product;
use App\Models\shop;
use App\Models\customer;
use App\Models\order;
use App\Models\shipping;
use App\Models\order_details;
use App\Models\gallery;
use App\Models\statistical;
use App\Models\statistical_admin;
use App\Models\rating;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;
session_start();

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
    	$count_category = category_product::count();
    	$count_shop = shop::count();
    	$count_customer = customer::count();
        $now = carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $dauthang = Carbon::now("Asia/Ho_Chi_Minh")->startOfMonth()->toDateString();
        $count_order_success = order::whereBetween('order_date',[$dauthang,$now])->where('order_status',3)->get();
        $revenue=0;
        $count_order=0;
        foreach ($count_order_success as $key => $val) {
            $revenue += $val->total;
            $count_order+=1;
        }
        $admin = admin::get();
        $admin_roles = admin_roles::get();
        $count_author = 0;
        $count_logictis = 0;
        foreach ($admin as $key => $val_admin) {
            foreach ($admin_roles as $key2 => $val_admin_roles) {
                if ($val_admin->admin_id==$val_admin_roles->admin_admin_id) {
                    if ($val_admin_roles->roles_id_roles==2) {
                        $count_author+=1;
                    }
                    if ($val_admin_roles->roles_id_roles==3) {
                        $count_logictis+=1;
                    }
                }
            }
        }
    	return view('admin.dashboard')->with(compact('count_product','count_category','count_shop','count_customer','count_author','count_logictis','revenue','count_order'));
    }

    public function statistical_30_days_admin(Request $request){
    $sub30days = carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $now = carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $get = statistical_admin::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales_admin,
            'quantity' => $val->quantity_admin,
            'percentage_fee' => $val->percentage_fee_admin
        );
    }
    echo $data = json_encode($chart_data);
}

public function filter_by_date_admin(Request $request){
    $data = $request->all();
    $from_date = $request->from_date;
    $to_date = $request->to_date;

    $get = statistical_admin::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales_admin,
            'quantity' => $val->quantity_admin,
            'percentage_fee' => $val->percentage_fee_admin
        );
    }
    echo $data = json_encode($chart_data);
}

public function dashboard_filter_admin(Request $request){
    $data = $request->all();
    $dauthangnay = Carbon::now("Asia/Ho_Chi_Minh")->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now("Asia/Ho_Chi_Minh")->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now("Asia/Ho_Chi_Minh")->subMonth()->endOfMonth()->toDateString();

    $sub7days = Carbon::now("Asia/Ho_Chi_Minh")->subdays(7)->toDateString();
    $sub365days = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();

    $now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();

    if ($data['dashboard_value']=='7ngay') {
        $get = statistical_admin::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
    }else if($data['dashboard_value']=='thangtruoc'){
        $get = statistical_admin::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
    }else if($data['dashboard_value']=='thangnay'){
        $get = statistical_admin::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
    }else{
        $get = statistical_admin::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
    }

    foreach ($get as $key => $val) {
        $chart_data[] = array(
            'period' => $val->order_date,
            'sales' => $val->sales_admin,
            'quantity' => $val->quantity_admin,
            'percentage_fee' => $val->percentage_fee_admin
        );
    }
    echo $data = json_encode($chart_data);
}

}
