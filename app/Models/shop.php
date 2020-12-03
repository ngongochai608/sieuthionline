<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'shop_name', 'shop_email', 'shop_address','shop_password','shop_phone','shop_status','create_at','name_shop_owner','shop_view'
    ];
    protected $primaryKey = 'shop_id';
 	protected $table = 'tbl_shop';
}
