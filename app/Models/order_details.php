<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_code', 'product_id', 'product_name','product_price','product_sales_quantity','shop_id','order_details_status','feedback'
    ];
    protected $primaryKey = 'order_details_id';
 	protected $table = 'tbl_order_details';


 	public function product(){
 		return $this->belongsTo('App\Models\product','product_id');
 	}

 	public function shop(){
 		return $this->belongsTo('App\Models\shop','shop_id');
 	}
}
