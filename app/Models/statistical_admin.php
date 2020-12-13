<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistical_admin extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_date', 'sales_admin','quantity_admin','percentage_fee_admin'
    ];
    protected $primaryKey = 'statistical_admin_id';
 	protected $table = 'tbl_statistical_admin';
}
