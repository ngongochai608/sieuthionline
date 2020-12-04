<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class admin extends Authenticatable
{
	use HasFactory;
	public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone','admin_address'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Models\roles');
 	}	

 	public function getAuthPassword(){
 		return $this->admin_password;
 	}

 	public function hasAnyRoles($roles){
 		return null !== $this->roles()->whereIn('name',$roles)->first();
 	}

 	public function hasRole($role){
 		if($this->roles()->where('name',$role)->first()){
 			return true;
 		}
 		return false;
 	}
}
