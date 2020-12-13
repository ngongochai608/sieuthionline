<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistical extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_date', 'sales','quantity','profit','percentage_fee','shop_id'
    ];
    protected $primaryKey = 'id_statistical';
 	protected $table = 'tbl_statistical';
}
