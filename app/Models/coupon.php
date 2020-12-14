<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'coupon_name', 'coupon_code', 'coupon_quantity','coupon_feature','coupon_number'
    ];
    protected $primaryKey = 'coupon_id';
 	protected $table = 'tbl_coupon';
}
