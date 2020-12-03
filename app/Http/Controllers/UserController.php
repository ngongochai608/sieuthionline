<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\admin;
use App\Models\roles;
use Auth;
class UserController extends Controller
{
	public function AuthLogin(){
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('/dashboard');
		}else{
			return Redirect::to('/admin')->send();
		}
	}
    public function index(){
    	$this->AuthLogin();
    	$admin = admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
    	return view('admin.users.all_users')->with(compact('admin'));
    }

    public function assign_roles(Request $request){
    	$user = admin::where('admin_email',$request->admin_email)->first();
    	$user->roles()->detach();
    	if ($request->author_role) {
    		$user->roles()->attach(roles::where('name','author')->first());
    	}
    	if ($request->admin_role) {
    		$user->roles()->attach(roles::where('name','admin')->first());
    	}
    	if ($request->logistics_role) {
    		$user->roles()->attach(roles::where('name','logistics')->first());
    	}
    	return Redirect::back()->with('message','Cấp quyền thành công');
    }
}