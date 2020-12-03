<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_email', 'product_quantity', 'product_slug','category_id','product_desc','product_price','product_image','product_status','id_shop','product_sold','product_view','comment_product'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';
}
